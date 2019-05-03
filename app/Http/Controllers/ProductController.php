<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class ProductController extends Controller
{
    public function create(ProductsRequest $productsRequest)
    {
        $attributes = $productsRequest->validated();
        $products = DB::table('products')->insert($attributes);

        if ($products):
            return response()->json([
                'status' => 'success',
                'message' => 'Saved Successfully'
            ]);
        else:
            return response()->json([
                'status' => 'error',
                'error' => 'Insert Error'
            ]);
        endif;

    }
}
