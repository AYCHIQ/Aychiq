<?php

namespace App\Http\Controllers;

use App\Http\Resources\ImagesResource;
use App\Images;
use Illuminate\Http\Request;

class CategoryImageController extends Controller
{
    public function upload(Request $request)
    {
        $file = $request->file('image');

        if (is_null($file)):
            return response()->json([
                'status' => 'error',
                'error' => 'Invalid File'
            ]);
        endif;

        $path = $request->file('image')->store('category');

        $images = Images::create([
            'image_name' => $file->getClientOriginalName(),
            'image_url' => $path,
        ]);

        if (!is_null($images)):

            return response()->json([
                'status' => 'success',
                'message' => 'Saved Successfully',
                'data' => new ImagesResource($images),
            ]);
        else:
            return response()->json([
                'status' => 'error',
                'error' => 'Insert Error'
            ]);
        endif;
    }
}
