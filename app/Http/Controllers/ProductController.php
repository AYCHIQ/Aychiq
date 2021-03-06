<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsRequest;
use App\Product;
use App\Http\Resources\Product as ProductResources;
use App\Repository\Imageble\ImagebleHelper;

class ProductController extends Controller
{
    use ImagebleHelper;

    public function create(ProductsRequest $productsRequest)
    {
        $attributes = $productsRequest->validated();
        $products = Product::create($attributes);


        if (!is_null($products)):

            $this->insert_images('product', $products->id);

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

    public function delete(Product $product)
    {
        $product->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Delete Successfully',
            'data' => [
                'id' => $product->id,
            ],
        ]);
    }
}
