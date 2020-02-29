<?php

use Faker\Generator as Faker;

$factory->define(Docuco\Models\UsersGroupModel::class, function (Faker $faker) {
    return [
        'name' => $faker->word
    ];
});
