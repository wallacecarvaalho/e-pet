<?php

use Faker\Generator as Faker;

$factory->define(App\Estoque::class, function (Faker $faker) {
    $num = $faker->numberBetween(1,2);
    if($num == 1){
        $texto = "Disponivel";
    } else {
        $texto = "Indisponivel";
    }
    return [
        //'status'=> $faker->realText(10),
        'status'=> $texto,
        'qtd'=> $faker->randomNumber(2),
    ];
});
