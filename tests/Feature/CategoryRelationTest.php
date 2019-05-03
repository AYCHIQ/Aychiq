<?php

namespace Tests\Feature;

use App\Category;
use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryRelationTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     * @test
     */
    public function can_save_category_relation_with_add_product()
    {
        $cat = factory(Category::class)->create([
            'name' => 'cat'
        ]);

        $dog = factory(Category::class)->create([
            'name' => 'dog'
        ]);

//        $products = factory(Product::class)->create([
//            'category' => [$cat->id, $dog->id]
//        ]);

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'sku' => $this->faker->randomDigit,
            'category' => [$cat->id, $dog->id],
        ];

        $response = $this->post('/api/products', $attributes);

        dd($response->getContent());

        $this->assertCount(2, $products->category);

    }

}
