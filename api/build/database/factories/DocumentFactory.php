<?php

use Faker\Generator as Faker;

$factory->define(Docuco\Models\DocumentModel::class, function (Faker $faker) {
    return [
    'name' => $faker->word,
    'description' => $faker->text(200),
    'price' => $faker->randomFloat(3),
    'url' => $faker->imageUrl,
    'date_of_issue' => $faker->date(),
    'user_group_id' => $faker->randomDigitNotNull,
    ];
});
