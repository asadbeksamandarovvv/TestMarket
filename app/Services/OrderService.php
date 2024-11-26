<?php

namespace App\Services;

use App\Data\OrderData;
use App\Data\OrderFilterData;
use App\Data\RegisterProductData;
use App\Enums\ActionTypeEnum;
use App\Enums\OrderStatusEnum;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderService
{
    public function __construct(
        protected RegisterProductService $registerProductService
    ) {
    }

    public function index(OrderFilterData $filterData)
    {
        return Order::query()
            ->when($filterData->status, function ($query) use ($filterData) {
                $query->whereIn('status', $filterData->status);
            })
            ->when($filterData->my_orders, function ($query) {
                $query->where('client_id', auth()->id());
            })
            ->where('status', '!=', OrderStatusEnum::CANCELED)
            ->with([
                       'courier',
                       'tariff',
                       'orderProducts.product.image',
                   ])
            ->orderByDesc('id')
            ->get();
    }

    public function create(OrderData $data)
    {
        $user       = auth()->user();
        $totalPrice = 0;

        foreach ($data->products as $product) {
            $productModel = Product::findOrFail($product->product_id);
            $this->registerProductService->store(new RegisterProductData(
                                                     $product->product_id,
                                                     $product->quantity,
                                                     $productModel->price ?? 0,
                                                     $productModel->selling_price ?? 0,
                                                     ActionTypeEnum::OUTCOME,
                                                 ));

            $totalPrice += $productModel->selling_price * $product->quantity;
        }

        $order = Order::query()
            ->create([
                         'branch_id'   => 1,
                         'tariff_id'   => 1,
                         'client_id'   => $user->id,
                         'total_price' => $totalPrice,
                         'address'     => $data->address,
                         'lat'         => $data->lat,
                         'lng'         => $data->lng,
                     ]);

        foreach ($data->products as $product) {
            $productModel = Product::findOrFail($product->product_id);

            $order->orderProducts()->create([
                                                'product_id'  => $product->product_id,
                                                'price'       => $productModel->selling_price ?? 0,
                                                'quantity'    => $product->quantity,
                                                'total_price' => $productModel->selling_price * $product->quantity,
                                            ]);
        }

        return Order::query()
            ->with([
                       'orderProducts.product',
                       'courier',
                       'tariff',
                   ])
            ->find($order->id);
    }

    public function show($id)
    {
        return Order::query()
            ->with([
                       'orderProducts.product',
                   ])
            ->findOrFail($id);
    }

    public function cancel($id)
    {
        Order::query()
            ->where('id', $id)
            ->update([
                         'status'      => OrderStatusEnum::CANCELED,
                         'canceled_at' => now(),
                     ]);
    }

    public function accept($order_id)
    {
        $order = Order::query()
            ->where('status', OrderStatusEnum::NEW)
            ->where('id', $order_id)
            ->where('courier_id', auth()->id())
            ->firstOrFail();

        $order->update([
                           'courier_id' => auth()->id(),
                           'status'     => OrderStatusEnum::ACCEPTED,
                       ]);
    }

    public function take($order_id)
    {
        $order = Order::query()
            ->where('status', OrderStatusEnum::ACCEPTED)
            ->where('id', $order_id)
            ->firstOrFail();

        $order->update([
                           'courier_id' => auth()->id(),
                           'status'     => OrderStatusEnum::DELIVERY,
                       ]);

        return $order->loadMissing('orderProducts.product');
    }

    public function done($order_id)
    {
        $order = Order::query()
            ->where('status', OrderStatusEnum::DELIVERY)
            ->where('id', $order_id)
            ->where('courier_id', auth()->id())
            ->firstOrFail();

        $order->update([
                           'courier_id'   => auth()->id(),
                           'status'       => OrderStatusEnum::DONE,
                           'delivered_at' => now(),
                       ]);

        return $order->loadMissing('orderProducts.product');
    }


}
