<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Doctor;
use App\Department;
use App\Hospital;
use Faker\Generator as Faker;

$factory->define(Doctor::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'department_id' => Department::all()->random(),
        'hospital_id' => Hospital::all()->random()
    ];
});
