<?php

use Faker\Generator as Faker;

$factory->define(App\Model\Question::class, function (Faker $faker) {
    $title = $faker->sentence;

    return [        // 'title','slug','body','category_id','user_id'
        'title' => $title,
        'slug' => str_slug($title),
        'body' => $faker->text,
        'category_id' => function() {
            return App\Model\Category::all()->random();
        },
        'user_id' => function() {
            return App\Model\User::all()->random();
        }
    ];
});
