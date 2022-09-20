<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function index() {
        $products = Product::paginate(6);

        $data = [
            'success' => true,
            'results' => $products
        ];

        return response()->json($data);
    }
}
