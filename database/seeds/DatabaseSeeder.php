<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminUsersTableSeeder::class,
            UserInfosTableSeeder::class,
            UsersTableSeeder::class,
            DailyReportsTableSeeder::class,
            StoresTableSeeder::class,
            RentInfosTableSeeder::class,
            ItemsTableSeeder::class,
            ItemCategoriesTableSeeder::class,
            TagCategoriesSeeder::class
        ]);
    }
}

