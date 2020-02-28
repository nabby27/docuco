<?php

use Faker\Generator as Faker;

$factory->define(Docuco\Models\UserModel::class, function (Faker $faker) {
    return [
        'id' => $faker->randomDigitNotNull,
        'name' => $faker->word,
        'email' => $faker->email,
        'password' => $faker->password,
        'token' => $faker->text(100),
        'role_id' => $faker->randomDigitNotNull,
        'users_group_id' => $faker->randomDigitNotNull
    ];
});
