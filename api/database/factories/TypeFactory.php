<?php

use Faker\Generator as Faker;

$factory->define(Docuco\Models\TypeModel::class, function (Faker $faker) {
    return [
    'name' => $faker->word
    ];
});
