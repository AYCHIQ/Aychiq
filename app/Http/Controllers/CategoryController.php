<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function create(CategoryRequest $categoryRequest)
    {
        $attributes = $categoryRequest->validated();

        if ($attributes):
            $category = DB::table('category')->insert($attributes);
        else:
            return response()->json([
                'status' => 'error',
                'error' => 'Validation Error'
            ]);
        endif;


        if ($category):
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
