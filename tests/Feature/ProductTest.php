<?php

namespace Tests\Feature;

use App\Category;
use App\Images;
use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     * @test
     */
    public function can_create_products()
    {

        $this->withoutExceptionHandling();

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'sku' => $this->faker->randomDigit,
        ];

        $response = $this->post('/api/products', $attributes);

        $response->assertJson([
            'status' => 'success',
            'message' => 'Saved Successfully',
            'data' => $attributes,
        ]);

        $this->assertDatabaseHas('products', $attributes);

    }


    /**
     * @test
     */

    public function product_must_have_title()
    {
//        $this->withoutExceptionHandling();

        $attributes = [
            'title' => '',
            'description' => $this->faker->paragraph,
            'sku' => $this->faker->randomDigit,
        ];

        $response = $this->post('/api/products', $attributes);
        $response->assertStatus(302);
        $response->assertSessionHasErrors('title');
    }

    /**
     * @test
     */

    public function product_must_have_sku()
    {
//        $this->withoutExceptionHandling();

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'sku' => '',
        ];

        $response = $this->post('/api/products', $attributes);
        $response->assertStatus(302);
        $response->assertSessionHasErrors('sku');
    }


    /**
     * @test
     */

    public function product_must_have_return_category_with_category()
    {
        $this->withoutExceptionHandling();

        $cat = factory(Category::class)->create([
            'name' => 'cat'
        ]);

        $dog = factory(Category::class)->create([
            'name' => 'dog'
        ]);

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'sku' => 5,
            'category' => [$cat->id, $dog->id]
        ];

        $response = $this->post('/api/products', $attributes);
        $response->assertStatus(200);

        $response_json = json_decode($response->getContent());

        $response->assertJson([
            'status' => 'success',
            'message' => 'Saved Successfully',
            'data' => [
                'id' => $response_json->data->id,
                'title' => $response_json->data->title,
                'description' => $response_json->data->description,
                'sku' => 5,
                'category' => [
                    [
                        "id" => $cat->id,
                        "name" => $cat->name,
                        "description" => $cat->description
                    ],
                    [
                        "id" => $dog->id,
                        "name" => $dog->name,
                        "description" => $dog->description
                    ]
                ]
            ]
        ]);

    }


    /**
     * @test
     */


    public function can_upload_image_with_product()
    {
        $this->withoutExceptionHandling();

        $dog = factory(Images::class)->create([
            'image_url' => 'category/ZjXLGo4S4g8J4Oli3Grgu9wyN8UOaGtiBTbB4WRd.jpeg'
        ]);


        $cat = factory(Images::class)->create([
            'image_url' => 'category/QXTMVNdyIfiQZp3OJ38140oqWHAO3hTHXOtcvT85.jpeg'
        ]);

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'sku' => 5,
            'images' => [$dog->id, $cat->id],
        ];

        $response = $this->post('/api/products', $attributes);

        $json_response = json_decode($response->getContent());

        $products = Product::where('id', $json_response->data->id)->get()->first();

        $this->assertCount(2, $products->images);
        $this->assertEquals('category/QXTMVNdyIfiQZp3OJ38140oqWHAO3hTHXOtcvT85.jpeg', $products->images[1]->image_url);

    }

}
