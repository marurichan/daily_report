<?php

use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('attendance')->truncate();
        DB::table('attendance')->insert([
            [
                'user_id'    => 2,
                'start_time' => '2019-01-15 09:50:22',
                'end_time'   => '2019-01-15 09:50:22',
                'absent_flg' => 0,
                'date'       => '2019-01-15',
            ]
        ]);
    }
}

