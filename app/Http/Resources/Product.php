<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $products = [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'sku' => $this->sku,
        ];

        if (!empty($this->category)):
            $products['category'] = new CategoryCollection($this->category);
        endif;

        return $products;
    }
}
