<?php

use Faker\Generator as Faker;

$factory->define(App\Item::class, function (Faker $faker) {
    return [
        'item_category_id' => \App\ItemCategory::all()->random()->id,
        'item_code' => $faker->numerify('ITEM####'),
        'item_description' => $faker->word,
        'item_specification' => $faker->sentence,
        'item_brand' => $faker->word,
        'item_price' => $faker->randomNumber(6, false),
        'uom_id' => \App\SapUom::all()->random()->id,
        'supplier_id' => \App\Supplier::all()->random()->id,
        'lead_times' => collect(['Week', 'Weeks', 'Ready'])->random(),
        'remarks' => $faker->word,
        'feature_image' => $faker->image(public_path('uploads'), 200, 400, 'technics', false)
    ];
});
