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
        $this->call(ReservationsTableSeeder::class);
        $this->call(RoomsTableSeeder::class);
        $this->call(DaysTableSeeder::class);
        $this->call(SemesterTableSeeder::class);

        DB::table('divisions')->insert([
            'name' => 'Division of Physical Sciences and Mathematics'
        ]);

        DB::table('divisions')->insert([
            'name' => 'Division of Humanities'
        ]);

        DB::table('divisions')->insert([
            'name' => 'Division of Biological Sciences'
        ]);

        DB::table('divisions')->insert([
            'name' => 'Division of Social Sciences'
        ]);

        DB::table('divisions')->insert([
            'name' => 'Department of Chemistry'
        ]);




    }
}
