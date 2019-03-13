<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

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
                'start_time' => Carbon::create(2019, 1, 15, 9, 50, 22),
                'end_time'   => Carbon::create(2019, 1, 15, 19, 30, 28),
                'absent_flg' => 0,
                'date'       => Carbon::create(2019, 1, 15, 0, 0, 0),
            ]
        ]);
    }
}

