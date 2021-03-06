<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\UpdateProductPrice;
use App\Models\Product;
use Illuminate\Http\Request;

class ToolController extends Controller
{
    public function updateProductPrice()
    {
        $products = Product::all();

        foreach ($products as $product) {
            UpdateProductPrice::dispatch($product)->onQueue('tool');
        }
    }
}
