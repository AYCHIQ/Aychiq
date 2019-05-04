<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['title', 'description', 'sku'];

    public function category()
    {
        return $this->belongsToMany(Category::class, 'category_relations', 'products_id', 'category_id');
    }

    public function images()
    {
        return $this->morphToMany('App\Images', 'imageble');
    }
}
