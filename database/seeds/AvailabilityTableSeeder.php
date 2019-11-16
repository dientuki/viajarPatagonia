<?php

use Illuminate\Database\Seeder;

class AvailabilityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('availability')->insert([
            'id' => 1,
        ]);
        DB::table('availability')->insert([
            'id' => 2
        ]);     
    }
}
