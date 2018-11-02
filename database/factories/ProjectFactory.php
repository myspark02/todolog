<?php

use Faker\Generator as Faker;

$factory->define(App\Project::class, function (Faker $faker) {
    $min = App\User::min('id');
    $max = App\User::max('id');
    $ct = $faker->dateTimeBetween($startDate = '-2 years', $endDate = '-1 years');
    return [
    	'user_id' => $faker->numberBetween($min, $max),
    	'name' => substr($faker->word, 0, 20),
    	'description' => $faker->sentence,
    	'created_at' => $ct,
    	'updated_at' => $faker->dateTimeBetween($startDate = $ct->modify('+1 months'), $endDate = 'now'),
    ];
});
