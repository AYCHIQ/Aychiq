<?php

namespace Tests\Feature;

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
}
