<?php


namespace App\Repository\Imageble;

use App\Imageble;

trait ImagebleHelper
{

    public function insert_images($type, $id)
    {
        $images = request('images');
        $imageble = app()->make(Imageble::class);


        if (empty($images)):
            return;
        endif;

        $data = [];

        foreach ($images as $image):
            $data[] = [
                'imageble_type' => $type,
                'images_id' => $image,
                'imageble_id' => $id,
            ];
        endforeach;

        $imageble->insert($data);
    }
}