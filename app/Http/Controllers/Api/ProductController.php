<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProducts()
    {
        $datas = [
            [
                'id' => 1,
                'name' => '商品1',
                'price' => 100,
            ],
            [
                'id' => 2,
                'name' => '商品2',
                'price' => 50,
            ],
        ];

        return response($datas);
    }
}
