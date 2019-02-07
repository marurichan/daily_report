<?php

use Illuminate\Database\Seeder;
use App\Models\AdminUsers;

class AdminUsersTableSeeder extends Seeder
{
    public function run()
    {
        AdminUsers::truncate();

        AdminUsers::create([
            'name' => 'gizumo-admin',
            'password' => bcrypt('gizumo0515'),
            'user_info_id' => 2,
            'privileges' => 1,
        ]);
    }
}

