<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryRelation extends Model
{
    protected $fillable = ['products_id', 'category_id'];
}
