<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Hospital;
use Faker\Generator as Faker;

$factory->define(Hospital::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude,
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
