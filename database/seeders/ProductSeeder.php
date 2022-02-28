<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::upsert([
            'title' => '商品標題aaa',
            'content' => '商品內容aaa',
            'price' => rand(0, 300),
            'quantity' => 50,
        ], ['id']);
    }
}
