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
<<<<<<< be40abcd9567b243b6d1890e0711d7fcbc81bcfa
            'name' => 'B1',
            'level' => 'Basement'
        ));
=======
	        'name' => 'B1',
            'level' => 'Basement'
	    ));
>>>>>>> 8693df2a386a8cbdf1e6aeeea12e1e16019f7a57
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
