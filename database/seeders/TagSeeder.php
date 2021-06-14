<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run()
    {
        Tag::create([
        	'hu_name' 	=> 'gluténmentes',
        	'en_name' 	=> 'gluten free',
        ]);

        Tag::create([
        	'hu_name' => 'laktózmentes',
        	'en_name' => 'lactose free',
        ]);

        Tag::create([
        	'hu_name' => 'vegetáriánus',
        	'en_name' => 'vegetarian',
        ]);
    }
}
