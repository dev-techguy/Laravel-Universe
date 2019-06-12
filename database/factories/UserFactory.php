<?php

/** @var Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Str;
use Webpatser\Uuid\Uuid;

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

$factory->define(User::class, function (Faker $faker) {
    return [
        'id' => Uuid::generate()->string,
        'name' => $faker->name,
        'email' => 'user@test.com',
        'email_verified_at' => now(),
        'password' => bcrypt('user@test.com'), // password
        'remember_token' => Str::random(10),
    ];
});
