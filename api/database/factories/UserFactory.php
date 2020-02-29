<?php

use Faker\Generator as Faker;

$factory->define(Docuco\Models\UserModel::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'email' => $faker->email,
        'password' => $faker->password,
        'role_id' => $faker->randomDigitNotNull,
        'users_group_id' => $faker->randomDigitNotNull
    ];
});
