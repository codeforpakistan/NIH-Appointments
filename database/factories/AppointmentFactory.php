<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Appointment;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


$factory->define(Appointment::class, function (Faker $faker) {
    $random = $faker->randomDigitNotNull;
    $today = roundToNearestMinuteInterval($faker->dateTimeThisMonth());
    $today = Carbon\Carbon::parse($today);
    return [
        'slug'          => Str::uuid(),
        'user_id'       => App\User::role('caller')->get()->random(),
        'hospital_id'   => App\Hospital::all()->random(),
        'start'         => $today->addDays($random),
        'finish'        => $today->addDays($random)->addMinutes(15),
        'created_at'    => $today->subDays($random)
    ];
});

/**
 * Round minutes to the nearest interval of a DateTime object.
 * 
 * @param \DateTime $dateTime
 * @param int $minuteInterval
 * @return \DateTime
 */
function roundToNearestMinuteInterval(\DateTime $dateTime, $minuteInterval = 15)
{
    return $dateTime->setTime(
        $dateTime->format('H'),
        round($dateTime->format('i') / $minuteInterval) * $minuteInterval,
        0
    );
}
