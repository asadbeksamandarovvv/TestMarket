<?php

namespace App\Services;

use App\Data\RegisterProductData;
use App\Enums\ActionTypeEnum;
use App\Models\Product;
use App\Models\RegisterProduct;

class RegisterProductService
{
    public function index()
    {
        return RegisterProduct::query()
            ->with(['product'])
            ->paginate(10);
    }

    public function store(RegisterProductData $data)
    {
        RegisterProduct::query()
            ->create([
                         'product_id'    => $data->product_id,
                         'quantity'      => $data->quantity,
                         'price'         => $data->price,
                         'selling_price' => $data->selling_price,
                         'action_type'   => $data->action_type,
                     ]);
        Product::query()
            ->where('id', $data->product_id)
            ->update([
                         'price'         => $data->price,
                         'selling_price' => $data->selling_price,
                     ]);
    }
}
