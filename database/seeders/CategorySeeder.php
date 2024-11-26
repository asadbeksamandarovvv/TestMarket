<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{

    public function run(): void
    {
        $ichimliklar  = Category::create(['name' => 'Ichimliklar']);
        Category::create(['name' => 'Gazli suvlar', 'parent_id' => $ichimliklar->id]);
        Category::create(['name' => 'Sharbatlar', 'parent_id' => $ichimliklar->id]);
    }
}
