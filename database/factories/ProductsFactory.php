<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'title' => $this->faker->sentence,
        'description' => $this->faker->paragraph,
        'sku' => $this->faker->randomDigit,
    ];
});
