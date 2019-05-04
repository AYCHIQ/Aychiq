<?php

namespace App\Observers;

use App\Product;
use App\Repository\CategoryRelation\InsertCategoryRelation;
use Illuminate\Http\Request;

class ProductObserver
{
    /**
     * Handle the product "created" event.
     *
     * @param \App\Product $product
     * @param Request $request
     * @return void
     */
    public function created(Product $product)
    {
        $insertCategory = app()->make(InsertCategoryRelation::class);
        $categories = \request('category');
        $insertCategory->insert($categories, $product->id);
    }

    /**
     * Handle the product "updated" event.
     *
     * @param \App\Product $product
     * @return void
     */
    public function updated(Product $product)
    {
        //
    }

    /**
     * Handle the product "deleted" event.
     *
     * @param \App\Product $product
     * @return void
     */
    public function deleted(Product $product)
    {
        //
    }

    /**
     * Handle the product "restored" event.
     *
     * @param \App\Product $product
     * @return void
     */
    public function restored(Product $product)
    {
        //
    }

    /**
     * Handle the product "force deleted" event.
     *
     * @param \App\Product $product
     * @return void
     */
    public function forceDeleted(Product $product)
    {
        //
    }
}
