<?php

use Faker\Generator as Faker;

$factory->define(App\Model\User::class, function (Faker $faker) {
    $gender = $faker->randomElement(['M', 'F']);

    return [    // 'firstname','lastname','username','email','mobile','email_verified_at','password','gender','role','photo'
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
        'username' => $faker->userName,
        'email' => $faker->unique()->safeEmail,
        'mobile' => $faker->unique()->phoneNumber,
        //'email_verified_at' => now(),
        'password' => bcrypt('secret'), // secret
        'gender' => $gender,
        'role' => 'Accountant',
        'photo' => ($gender == 'M')? 'default.male.png' : 'default.female.png',
        'remember_token' => str_random(10),
    ];
});
