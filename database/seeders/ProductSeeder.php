<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{

    public function run(): void
    {
        $brand1 = Brand::firstOrCreate(['name' => 'Coca Cola']);
        $brand2 = Brand::firstOrCreate(['name' => 'Maxito']);
        $brand3 = Brand::firstOrCreate(['name' => 'Non']);
        $brand4 = Brand::firstOrCreate(['name' => 'Fanta']);
        $brand5 = Brand::firstOrCreate(['name' => 'Yogurt']);

        Product::create([
            'name' => 'Coca Cola 500ml',
            'bar_code' => '123456789012',
            'code' => 10001,
            'category_id' => 3,
            'brand_id' => $brand1->id,
        ]);

        Product::create([
            'name' => 'Maxito Chocolate',
            'bar_code' => '123456789013',
            'code' => 10002,
            'category_id' => 2,
            'brand_id' => $brand2->id,
        ]);

        Product::create([
            'name' => 'Fanta 500ml',
            'bar_code' => '123456789014',
            'code' => 10003,
            'category_id' => 3,
            'brand_id' => $brand4->id,
        ]);

        Product::create([
            'name' => 'Non Bread',
            'bar_code' => '123456789015',
            'code' => 10004,
            'category_id' => 2,
            'brand_id' => $brand3->id,
        ]);

        Product::create([
            'name' => 'Yogurt 250g',
            'bar_code' => '123456789016',
            'code' => 10005,
            'category_id' => 3,
            'brand_id' => $brand5->id,
        ]);
    }
}
