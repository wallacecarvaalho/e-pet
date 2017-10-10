<?php

use Faker\Generator as Faker;

$factory->define(App\Produto::class, function (Faker $faker) {
    
    return [
        'name' => $faker->name,
        'descricao'=> $faker->word,
        'preco'=>$faker->randomNumber(4),
    ];

});
