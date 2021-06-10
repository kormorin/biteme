<?php

namespace Database\Seeders;

use App\Models\AdminUser;
use Illuminate\Database\Seeder;

class SuperUserSeeder extends Seeder
{
    public function run()
    {
        AdminUser::create([
        	'name' => 'Klein Ádám',
        	'email' => 'mr.adam.klein@gmail.com',
        	'password' => bcrypt('ooCah2aasoThu1vu'),
        	'is_super_user' => true
        ]);
    }
}
