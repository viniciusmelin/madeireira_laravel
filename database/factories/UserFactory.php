<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\People::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'cpfcnpj' => $faker->ean8,
        'active' => 1


    ];
});
$factory->define(App\Product::class,function(Faker $faker){
    return [
        'description'=>$faker->name,
        'active'=>1,
        'width'=>1,
        'height'=>1,
        'deep'=>1,
        'amount_min'=>1,
        'cubing'=>1,
        'amount'=>1,
        'price'=>1
    ];
});
