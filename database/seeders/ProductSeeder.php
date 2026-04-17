<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['name' => 'Honda Wave Alpha', 'price' => 15000000],
            ['name' => 'Yamaha Sirius', 'price' => 16000000],
            ['name' => 'Honda Vision', 'price' => 28000000],
            ['name' => 'Yamaha Exciter', 'price' => 45000000],
            ['name' => 'Honda Winner X', 'price' => 48000000],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}