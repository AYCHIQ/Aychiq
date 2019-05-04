<?php

namespace Tests\Feature;

use App\Category;
use App\Images;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{

    use WithFaker, RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     * @test
     */

    public function can_save_category()
    {
        $this->withoutExceptionHandling();

        $attributes = [
            'name' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
        ];

        $response = $this->post('/api/category', $attributes);

        $response->assertJson([
            'status' => 'success',
            'message' => 'Saved Successfully',
            'data' => $attributes,
        ]);

        $this->assertDatabaseHas('category', $attributes);

        $response->assertStatus(200);
    }

    /**
     * @test
     */

    public function category_must_have_name()
    {

        $attributes = [
            'name' => '',
            'description' => $this->faker->paragraph,
        ];

        $response = $this->post('/api/category', $attributes);

        $response->assertSessionHasErrors('name');

        $this->assertDatabaseMissing('category', $attributes);

    }


    /**
     * @test
     */


    public function can_upload_image_with_category()
    {
        $this->withoutExceptionHandling();

        $dog = factory(Images::class)->create([
            'image_url' => 'category/ZjXLGo4S4g8J4Oli3Grgu9wyN8UOaGtiBTbB4WRd.jpeg'
        ]);


        $cat = factory(Images::class)->create([
            'image_url' => 'category/QXTMVNdyIfiQZp3OJ38140oqWHAO3hTHXOtcvT85.jpeg'
        ]);

        $attributes = [
            'name' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'images' => [$cat->id, $dog->id]
        ];

        $response = $this->post('/api/category', $attributes);

        $json_response = json_decode($response->getContent());

        $category = Category::where('id', $json_response->data->id)->get()->first();

        $this->assertCount(2, $category->images);

    }

    /**
     * @test
     */


    public function can_delete_category()
    {
        $this->withoutExceptionHandling();

        $attributes = [
            'name' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
        ];

        $category = factory(Category::class)->create($attributes);

        $response = $this->delete("/api/category/{$category->id}");

        $response->assertJson([
            'status' => 'success',
            'message' => 'Delete Successfully',
            'data' => [
                'id' => $category->id,
            ]
        ]);

        $this->assertDatabaseMissing('category', $attributes);
    }
}
