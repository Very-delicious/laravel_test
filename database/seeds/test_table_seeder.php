<?php

use Illuminate\Database\Seeder;

class test_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
	DB::table('test')->insert(

	    [
		'name' => str_random(10),
		'email' => str_random(10).'@gmail.com'
	    ]
	);
    }
}
