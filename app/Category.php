<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $fillable = ['name', 'description'];

    public function images()
    {
        return $this->morphToMany('App\Images', 'imageble');
    }
}
