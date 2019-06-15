<?php

/** @var Factory $factory */

use App\County;
use App\Program;
use App\SemesterOne;
use App\SemesterTwo;
use App\Unit;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Str;
use MV\Notification\Models\Notification;
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
        'program_id' => Program::query()->inRandomOrder()->take(1)->first()->id,
        'county_id' => County::query()->inRandomOrder()->take(1)->first()->id,
        'name' => $faker->name('male'),
        'age' => $faker->numberBetween(16, 40),
        'email' => 'student@test.com',
        'phoneNumber' => $faker->phoneNumber,
        'registrationNumber' => 'LU/' . $faker->numberBetween(1000, 9000) . '/' . substr(date('Y'), 2, 2),
        'gender' => 'Male',
        'program_verified' => true,
        'email_verified_at' => now(),
        'password' => bcrypt('student@test.com'), // password
        'remember_token' => Str::random(10),
    ];
});


$factory->define(SemesterOne::class, function (Faker $faker) {
    return [
        'id' => Uuid::generate()->string,
        'unit_id' => Unit::query()->inRandomOrder()->where('semesterOne', true)->where('program_id', User::query()->first('program_id')->program_id)->first()->id,
        'catOne' => $faker->numberBetween(1, 30),
        'catTwo' => $faker->numberBetween(1, 30),
        'mainExam' => $faker->numberBetween(1, 99),
    ];
});


$factory->define(SemesterTwo::class, function (Faker $faker) {
    return [
        'id' => Uuid::generate()->string,
        'unit_id' => Unit::query()->inRandomOrder()->where('semesterOne', true)->where('program_id', User::query()->first('program_id')->program_id)->first()->id,
        'catOne' => $faker->numberBetween(1, 30),
        'catTwo' => $faker->numberBetween(1, 30),
        'mainExam' => $faker->numberBetween(1, 99),
    ];
});

$factory->define(Notification::class, function () {
    return [
        'id' => Uuid::generate()->string,
        'subject' => 'Welcome to ' . config('app.name'),
        'description' => 'We are glad that you have joined us. You gonna learn more on what laravel entails.',
    ];
});
