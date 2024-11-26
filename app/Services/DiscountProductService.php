<?php

namespace App\Services;

use App\Http\Requests\DiscountProductRequest;
use App\Http\Requests\DiscountUpdateProductRequest;
use App\Models\DiscountProduct;
use App\Models\Product;

class DiscountProductService
{
    public function index()
    {
        return DiscountProduct::query()
            ->with('product')
            ->paginate(10);
    }

    public function store(DiscountProductRequest $request)
    {
        $product        = Product::query()->find($request->product_id);
        $discount_price = 0;
        $percentage     = 0;

        if ($request->percentage) {
            $discount_price = $product->selling_price - ($product->selling_price * ($request->percentage / 100));
            $percentage     = $request->percentage;
        }
        if ($request->discount_price) {
            $percentage     = ($product->selling_price - $request->discount_price) / $product->selling_price * 100;
            $discount_price = $request->discount_price;
        }
        DiscountProduct::where('product_id', $product->id)
            ->update(['is_active' => false]);

        DiscountProduct::query()
            ->create([
                         'product_id'     => $product->id,
                         'percentage'     => intval($percentage),
                         'price'          => $product->selling_price,
                         'discount_price' => $discount_price,
                         'start_date'     => $request->start_date,
                         'end_date'       => $request->end_date,
                         'is_active'      => $request->is_active,
                     ]);
    }

    public function edit($id)
    {
        return DiscountProduct::query()
            ->with('image')
            ->findOrFail($id);
    }

    public function update(DiscountUpdateProductRequest $request, $id)
    {
        $product        = Product::find($request->product_id);

        $discount_price = 0;
        $percentage     = 0;

        if ($request->percentage) {
            $discount_price = $product->selling_price - ($product->selling_price * ($request->percentage / 100));
            $percentage     = $request->percentage;
        }
        if ($request->discount_price) {
            $percentage     = ($product->selling_price - $request->discount_price) / $product->selling_price * 100;
            $discount_price = $request->discount_price;
        }

        $discountProduct = DiscountProduct::findOrFail($id);

        $discountProduct->update([
                                     'product_id'     => $product->id,
                                     'percentage'     => intval($percentage),
                                     'price'          => $product->selling_price,
                                     'discount_price' => $discount_price,
                                     'start_date'     => $request->start_date,
                                     'end_date'       => $request->end_date,
                                     'is_active'      => $request->is_active,
                                 ]);
    }

    public function destroy($id)
    {
        return DiscountProduct::query()
            ->findOrFail($id)
            ->delete();
    }
}
