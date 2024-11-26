<?php

namespace App\Services;

use App\Enums\ActionTypeEnum;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class WareHouseService
{
    public function index()
    {
        return Product::query()
            ->addSelect([
                            'quantity' => DB::table('register_products')
                                ->selectRaw('COALESCE(SUM(CASE WHEN action_type = ? THEN quantity WHEN action_type = ? THEN -quantity END), 0)', [
                                    ActionTypeEnum::INCOME->value,
                                    ActionTypeEnum::OUTCOME->value,
                                ])
                            ->whereRaw('product_id = products.id')
                        ])
            ->orderBy('id')
            ->get();
    }
}
