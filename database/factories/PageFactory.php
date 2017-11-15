<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Page::class, function (Faker $faker) {
    return [
    	'title' => $faker->sentence(),
    	'slug' => $faker->url,
    	'content' => $faker->paragraph(),
    	'published_at' => null
    ];
});
