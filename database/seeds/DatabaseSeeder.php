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
        // $this->call(UsersTableSeeder::class);
//        DB::table('rooms')->insert([
//            'name' => 'R101'
//        ],[
//            'name' => 'R102'
//        ]);
//
//        DB::table('semesters')->insert([
//            'semester' => 'First Semester',
//            'start_year' => 2016,
//            'end_year' => 2017,
//            'status' => 'Active'
//        ]);
//
//        DB::table('reservations')->insert([
//            'user_id' => 1,
//            'status' => 'Dean Approved',
//            'date' => '1111-11-11',
//            'start_time' => '08:30:00',
//            'end_time' => '10:00:00',
//            'room_id' => 1,
//            'semester_id' => 1
//        ]);

        DB::table('days')->insert([
            'reservation_id' => 2,
            'day' => 'Monday',
        ], [
            'reservation_id' => 2,
            'day' => 'Thursday',
        ]);
    }
}
