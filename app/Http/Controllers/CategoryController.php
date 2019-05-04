<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\Category as CategoryResource;
use App\Repository\Imageble\ImagebleHelper;

class CategoryController extends Controller
{

    use ImagebleHelper;

    public function create(CategoryRequest $categoryRequest)
    {
        $attributes = $categoryRequest->validated();

        $category = Category::create($attributes);

        if (!is_null($category)):

            $this->insert_images('category', $category->id);

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
