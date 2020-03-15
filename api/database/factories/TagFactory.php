<?php

use Faker\Generator as Faker;

$factory->define(Docuco\Models\TagModel::class, function (Faker $faker) {
    return [
    'name' => $faker->word,
    ];
});
