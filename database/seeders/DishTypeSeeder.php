<?php

namespace Database\Seeders;

use App\Models\DishType;
use Illuminate\Database\Seeder;

class DishTypeSeeder extends Seeder
{
    public function run()
    {
        DishType::create([
        	'id' 		=> 1,
        	'hu_name' 	=> 'Előétel',
        	'en_name' 	=> 'Appetizer',
        ]);

        DishType::create([
        	'id' 		=> 2,
        	'hu_name' => 'Leves',
        	'en_name' => 'Soup',
        ]);

        DishType::create([
        	'id' 		=> 3,
        	'hu_name' => 'Főétel',
        	'en_name' => 'Main dish',
        ]);

        DishType::create([
        	'id' 		=> 4,
        	'hu_name' => 'Köret',
        	'en_name' => 'Side dish',
        ]);

        DishType::create([
        	'id' 		=> 5,
        	'hu_name' => 'Vega',
        	'en_name' => 'Vegetarian',
        ]);

        DishType::create([
        	'id' 		=> 6,
        	'hu_name' => 'Savanyúság',
        	'en_name' => 'Sour side dish',
        ]);

        DishType::create([
        	'id' 		=> 7,
        	'hu_name' => 'Desszert',
        	'en_name' => 'Dessert',
        ]);

    }
}
