<?php

use App\todo;
use App\todocontent;
use App\tools\generate as g;
use Faker\Generator as Faker;

$factory->define(todo::class, function () {
    $code=new g();
    $code=$code->gen_id();
    return [
       'name' => 'todo',
       'code' => $code,
       'hide' => 0
   ];
});

$factory->define(todocontent::class, function (Faker $faker) {
    

   $valu=[
    'value' => '',
    'finish' => $faker->boolean($chanceOfGettingTrue = 50)
    ];
    
    return $valu;
});





