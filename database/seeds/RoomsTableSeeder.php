<?php

use Illuminate\Database\Seeder;
use App\Room;
class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Room::create(array(
	        'name' => 'B1',
            'level' => 'Basement'
	    ));
        Room::create(array(
            'name' => 'B2',
            'level' => 'Basement'
        ));
        Room::create(array(
            'name' => 'B3',
            'level' => 'Basement'
        ));
        Room::create(array(
            'name' => 'B4',
            'level' => 'Basement'
        ));
        Room::create(array(
            'name' => '104',
            'level' => '1st Floor'
        ));
        Room::create(array(
            'name' => '105',
            'level' => '1st Floor'
        ));
        Room::create(array(
            'name' => '106',
            'level' => '1st Floor'
        ));
        Room::create(array(
            'name' => '107',
            'level' => '1st Floor'
        ));
        Room::create(array(
            'name' => '201',
            'level' => '2nd Floor'
        ));
        Room::create(array(
            'name' => '202',
            'level' => '2nd Floor'
        ));
        Room::create(array(
            'name' => '203',
            'level' => '2nd Floor'
        ));
        Room::create(array(
            'name' => '204',
            'level' => '2nd Floor'
        ));

    }
}
