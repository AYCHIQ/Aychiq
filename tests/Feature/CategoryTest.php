<?php

namespace Tests\Feature;

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
            'message' => 'Saved Successfully'
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
}
