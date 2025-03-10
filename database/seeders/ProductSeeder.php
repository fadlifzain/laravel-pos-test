<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::insert([
            ['name' => 'Product 1', 'price' => 10000, 'sku' => 'SKU001'],
            ['name' => 'Product 2', 'price' => 15000, 'sku' => 'SKU002'],
            ['name' => 'Product 3', 'price' => 20000, 'sku' => 'SKU003'],
            ['name' => 'Product 4', 'price' => 25000, 'sku' => 'SKU004'],
            ['name' => 'Product 5', 'price' => 30000, 'sku' => 'SKU005'],
        ]);
    }
}
