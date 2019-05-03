<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\Category as CategoryResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function create(CategoryRequest $categoryRequest)
    {
        $attributes = $categoryRequest->validated();

        $category = Category::create($attributes);

        if (!is_null($category)):
            return response()->json([
                'status' => 'success',
                'message' => 'Saved Successfully',
                'data' => new CategoryResource($category),
            ]);
        else:
            return response()->json([
                'status' => 'error',
                'error' => 'Insert Error'
            ]);
        endif;


    }
}
