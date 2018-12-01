<?php

use Faker\Generator as Faker;

$factory->define(App\Garbage::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'buy_price' => $faker->numberBetween(500, 99999),
        'sell_price' => $faker->numberBetween(500, 99999),
        'description' => $faker->paragraph($faker->numberBetween(6, 12)),
    ];
});
