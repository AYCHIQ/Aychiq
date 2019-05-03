<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsRequest;
use App\Product;
use App\Http\Resources\Product as ProductResources;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function create(ProductsRequest $productsRequest)
    {
        $attributes = $productsRequest->validated();
        $products = Product::create($attributes);

        if (!is_null($products)):
            return response()->json([
                'status' => 'success',
                'message' => 'Saved Successfully',
                'data' => new ProductResources($products),
            ]);
        else:
            return response()->json([
                'status' => 'error',
                'error' => 'Insert Error'
            ]);
        endif;

    }
}
