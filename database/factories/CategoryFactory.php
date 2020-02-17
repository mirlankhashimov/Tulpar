<?php

/** @var Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(\App\Category::class, function (Faker $faker) {
    return [
            'name' => $faker->name,
    ];
});
