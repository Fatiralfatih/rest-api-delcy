<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Gallery;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Category::factory(5)->create();
        Product::factory()
            ->count(10)
            ->state(fn() => ['category_id' => Category::select(['id'])->get()->random()])
            ->create();

        Gallery::factory(10)->state(fn() => ['product_id' => Product::select(['id'])->get()->random()])->create();
    }
}
