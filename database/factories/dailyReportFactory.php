<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\DailyReport::class, function (Faker $faker) {
    return [
        'user_id'        => 4,
        'title'          => $faker->realText(30),
        'content'        => $faker->realText(250),
        'reporting_time' => $faker->date('Y-m-d', 'now'),
    ];
});
