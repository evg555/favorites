<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Favorite;
use Faker\Generator as Faker;

$factory->define(Favorite::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(random_int(3, 8), true),
        'url' => $faker->unique()->url,
        'meta_description' => $faker->realText(50),
        'meta_keywords' => $faker->realText(50),
        'created_at' => $faker->dateTimeBetween('-2 month', '-1 day'),
        'updated_at' => $faker->dateTimeBetween('-2 month', '-1 day')
    ];
});
