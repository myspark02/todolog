<?php

use Faker\Generator as Faker;

$factory->define(App\Task::class, function (Faker $faker) {
    $min = App\Project::min('id');
    $max = App\Project::max('id');

    $dt = $faker->dateTimeBetween($startDate = '-1 months', $endDate = 'now');

    return [
        'project_id' => $faker->numberBetween($min, $max),
        'name' => substr($faker->sentence, 0, 20),
        'description' => $faker->text,
        'due_date' => $faker->dateTimeBetween($startDate = 'now + 1 days', $endDate =(new DateTime())->modify('+300 days')),
        'created_at' => $dt,
        'updated_at' => $dt,
    ];
});
