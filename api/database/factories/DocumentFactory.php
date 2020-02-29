<?php

use Faker\Generator as Faker;

$factory->define(Docuco\Models\DocumentModel::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->text(200),
        'price' => $faker->randomFloat,
        'url' => $faker->imageUrl,
        'dateOfIssue' => $faker->date(),
        'users_group_id' => $faker->randomDigitNotNull,
    ];
});
