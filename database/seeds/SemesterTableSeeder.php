<?php

use Illuminate\Database\Seeder;
use App\Semester;
<<<<<<< be40abcd9567b243b6d1890e0711d7fcbc81bcfa

=======
>>>>>>> 8693df2a386a8cbdf1e6aeeea12e1e16019f7a57
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
<<<<<<< be40abcd9567b243b6d1890e0711d7fcbc81bcfa
            'semester' => 'First Semester',
            'start_year' => 2016,
            'end_year' => 2017,
            'status' => 'Active'
        ));
=======
	        'semester' => '123456789',
            'start_year' => '2016',
            'end_year' => '2017',
            'status' => 'Active'
	    ));
>>>>>>> 8693df2a386a8cbdf1e6aeeea12e1e16019f7a57
    }
}
