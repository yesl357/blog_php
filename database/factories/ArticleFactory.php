<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| BlogType Model Factories
|--------------------------------------------------------------------------
*/

$factory->define(App\Models\Article::class, function (Faker $faker) {

    $date_time = $faker->date . ' ' . $faker->time;

    return [
        'title' => $faker->word,
        'desc' => $faker->name,
        'author' => $faker->name,
        'content' => $faker->text,
        'img' => 'https://lccdn.phphub.org/uploads/avatars/1_1530614766.png?imageView2/1/w/200/h/200',
        'created_at' => $date_time,
        'updated_at' => $date_time,
    ];
});
