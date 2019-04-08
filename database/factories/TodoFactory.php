<?php

use App\todo;
use Faker\Generator as Faker;

$factory->define(todo::class, function (Faker $faker) {
    return [
       'name' => 'todo',
       'code' => substr(md5(uniqid(rand(), true)),0,9),
       'hide' => $faker->numberBetween($min = 0, $max = 1)
   ];
});


