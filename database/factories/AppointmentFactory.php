<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Appointment;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


$factory->define(Appointment::class, function (Faker $faker) {
    
    $start = $faker->randomDigitNotNull;
    return [
        'slug'          => Str::uuid(),
        'user_id'       => App\User::role('caller')->get()->random(),
        'hospital_id'   => App\Hospital::all()->random(),
        'start'         => Carbon\Carbon::now()->addDays($start),
        'finish'        => Carbon\Carbon::now()->addDays($start)->addMinutes(15),
        'created_at'    => Carbon\Carbon::now()->subDays($start)
    ];
});
