<?php

use Faker\Generator as Faker;

$factory->define(Docuco\Models\UserGroupModel::class, function (Faker $faker) {
  return [
    'name' => $faker->word
  ];
});
