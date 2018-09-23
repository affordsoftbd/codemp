<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    $roleIds = App\Role::all()->pluck('id')->toArray();
    return [
        'parent_id' => '0',
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'active_session_id' => str_random(10),
        'last_login_time' => $faker->dateTime($max = 'now', $timezone = null),
        'last_logout_time' => $faker->dateTime($max = 'now', $timezone = null),
        'username' => $faker->unique()->userName,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
        'role_id' => $faker->randomElement($roleIds),
        'status' => "pending",
    ];
});
