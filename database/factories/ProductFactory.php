<?php

use Faker\Generator as Faker;

$factory->define(App\Produto::class, function (Faker $faker) {
    
    return [
        'name' => $faker->name,
        'descricao'=> $faker->word,
        'preco'=>$faker->randomNumber(4),
        'imagem'=> $faker->imageUrl,
        'status'=> $faker->randomElement($array = array ('Disponivel','Indisponivel')),
        'qtd'=> $faker->randomNumber(2),
        'categoria'=>$faker->randomElement($array = array ('Gato','Cachorro')),
    ];

});
