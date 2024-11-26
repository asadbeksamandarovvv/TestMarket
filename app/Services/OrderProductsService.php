<?php

namespace App\Services;

use App\Models\OrderProduct;

class OrderProductsService
{
    public function index()
    {

        return OrderProduct::query()
            ->with(['order', 'product']);
    }
}
