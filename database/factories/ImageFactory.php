<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Images::class, function (Faker $faker) {
    return [
        'image_name' => $faker->sentence,
        'image_url' => $faker->url,
    ];
});
