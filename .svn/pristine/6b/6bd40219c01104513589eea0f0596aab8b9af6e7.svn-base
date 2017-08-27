<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    $male = rand(0, 1);
    $roles = [
        'admin', 'guest'
    ];
    return [
        'fio' => ($male ? $faker->lastName : $faker->lastName . 'а') . ' А. А.',
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'email' => $faker->email,
        'login' => $faker->unique()->word,
        'role' => array_random($roles)
    ];
});
