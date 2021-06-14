<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
    	$this->call(DishTypeSeeder::class);
    	$this->call(DepartmentSeeder::class);
        $this->call(SuperUserSeeder::class);
        $this->call(TagSeeder::class);
    }
}
//