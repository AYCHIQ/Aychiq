<?php


namespace App\Repository\Helper;


use App\Category;
use App\Product;

class CategoryRelationHelper
{

    public static function is_product_exist($product_id)
    {
        $product = Product::where('id', $product_id)->get()->toArray();
        return empty($product) ? false : true;
    }

    public static function is_category_exist($category_ids)
    {
        $category = Category::whereIn('id', $category_ids)->get()->toArray();
        return empty($category) ? false : true;
    }
}