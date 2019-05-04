<?php

namespace App\Repository\CategoryRelation;

use App\CategoryRelation;
use App\Repository\Helper\CategoryRelationHelper;

class InsertCategoryRelation
{

    public function insert($categories, $product_id)
    {
        $category_relations = [];

        if (empty($categories)):
            return;
        endif;

        if (!CategoryRelationHelper::is_product_exist($product_id)):
            return;
        endif;

        if (!CategoryRelationHelper::is_category_exist($categories)):
            return;
        endif;

        foreach ($categories as $category):
            $category_relations[] = ['products_id' => $product_id, 'category_id' => abs($category)];
        endforeach;

        CategoryRelation::insert($category_relations);
    }
}