<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| BlogType Model Factories
|--------------------------------------------------------------------------
*/

$factory->define(App\Models\BlogType::class, function (Faker $faker) {

    $date_time = $faker->date . ' ' . $faker->time;

    return [
        'name' => $faker->name,
        'sort' => $faker->numberBetween(0, 255),
        'img_path' => 'https://lccdn.phphub.org/uploads/avatars/1_1530614766.png?imageView2/1/w/200/h/200',
        'created_at' => $date_time,
        'updated_at' => $date_time,
    ];
});
