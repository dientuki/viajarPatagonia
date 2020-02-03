<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use App\Inquiry;
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

$factory->define(Inquiry::class, function (Faker $faker) {
    $products = array('cruise', 'excursion', 'package');
    return [
      'name' => $faker->name,
      'email' => $faker->safeEmail,
      'phone' => $faker->phoneNumber,
      'departure' => $faker->date('d/m/Y', 'now'),
      'adult' => rand(1,10),
      'child' => rand(0,10),
      'comment' => $faker->paragraph,
      'product' => $products[rand(0,2)],
      'product_id' => rand(1,2),
      'fk_language' => rand(1,3),
      'is_readed' => rand(0,1),
      'nights' => rand(0,10)
    ];
});