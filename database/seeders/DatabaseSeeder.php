<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Database\Seeders\BrandSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(CategorySeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(UsersTableSeeder::class);

        // Attaching Categories to Poducts
        $categories = Category::all();
        $brands = Brand::all();

        Product::all()->each(
            fn ($product) => $product->categories()->attach(
                $categories->random(rand(1, 3))->pluck('id')->toArray()
            )
        );

        $categories->each(
            fn ($category) => $category->brands()->attach(
                $brands->random(rand(1, 3))->pluck('id')->toArray()
            )
        );
    }
}
