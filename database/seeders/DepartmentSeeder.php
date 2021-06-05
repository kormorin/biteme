<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run()
    {
        Department::create([
        	'hu_name' => 'Kamerások',
        	'en_name' => 'Camera department'
        ]);

        Department::create([
        	'hu_name' => 'Sminkesek',
        	'en_name' => 'Hair and makeup crew'
        ]);
    }
}
