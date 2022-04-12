<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $newProducts = Product::new()->get()->take(10);
        $hitProducts = Product::hit()->get()->take(5);

        return [
            'new_products' => ProductResource::collection($newProducts),
            'hit_products' => ProductResource::collection($hitProducts),
        ];
    }
}
