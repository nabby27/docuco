<?php

use Faker\Generator as Faker;

$factory->define(Docuco\Models\RoleModel::class, function (Faker $faker) {
    return [
        'id' => $faker->randomDigitNotNull,
        'name' => $faker->word
    ];
});
