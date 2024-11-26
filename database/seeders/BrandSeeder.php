<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::create(['name' => 'Coca Cola']);
        Brand::create(['name' => 'Non']);
        Brand::create(['name' => 'Fantasia']);
        Brand::create(['name' => 'Yogurt']);    }
}
