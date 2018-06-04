<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Exercise::class, function (Faker $faker) {
    return [
        'user_id' => '1',
        'name' => 'Bench Press',
        'rep_max_interval' => '5',
        'rep_max' => '230',
    ];
});
