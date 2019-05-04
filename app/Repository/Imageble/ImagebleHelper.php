<?php


namespace App\Repository\Imageble;

use App\Imageble;
use App\Images;

trait ImagebleHelper
{

    public function insert_images($type, $id)
    {
        $images = request('images');
        $imageble = app()->make(Imageble::class);

        if (empty($images) || !$this->is_image_exist($images)):
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

    public function is_image_exist($images)
    {
        $images = Images::whereIn('id', $images)->get()->toArray();
        return empty($images) ? false : true;
    }
}