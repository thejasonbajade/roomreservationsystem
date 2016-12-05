<?php

use Illuminate\Database\Seeder;
use App\Day;

class DaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Day::create(array(
            'reservation_id' => '1',
            'day' => 'Monday'
        ));
        Day::create(array(
            'reservation_id' => '1',
            'day' => 'Thursday'
        ));
        Day::create(array(
            'reservation_id' => '2',
            'day' => 'Monday'
        ));
        Day::create(array(
            'reservation_id' => '2',
            'day' => 'Thursday'
        ));
        Day::create(array(
            'reservation_id' => '3',
            'day' => 'Monday'
        ));
        Day::create(array(
            'reservation_id' => '3',
            'day' => 'Thursday'
        ));
        Day::create(array(
            'reservation_id' => '4',
            'day' => 'Tuesday'
        ));
        Day::create(array(
            'reservation_id' => '4',
            'day' => 'Friday'
        ));
        Day::create(array(
            'reservation_id' => '5',
            'day' => 'Monday'
        ));
        Day::create(array(
            'reservation_id' => '5',
            'day' => 'Friday'
        ));
        Day::create(array(
            'reservation_id' => '6',
            'day' => 'Wednesday'
        ));
    }
}
