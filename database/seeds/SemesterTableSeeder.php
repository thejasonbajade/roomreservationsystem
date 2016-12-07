<?php

use Illuminate\Database\Seeder;
use App\Semester;

class SemesterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Semester::create(array(
            'semester' => 'First Semester',
            'start_year' => 2016,
            'end_year' => 2017,
            'status' => 'Active'
        ));
    }
}
