<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Checklist;
use Faker\Generator as Faker;

$factory->define(Checklist::class, function (Faker $faker) {
    return [
        'name' => $faker -> word(),
        'description' => $faker -> sentence($nbWords = 6, $variableNbWords = true),
        'status' => $faker -> boolean($chanceOfGettingTrue = 0),
        'priority' => $faker -> randomDigit(),
    ];
});
