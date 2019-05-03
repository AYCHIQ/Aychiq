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


        $this->assertDatabaseHas('category', $attributes);

        $response->assertStatus(200);
    }
}
