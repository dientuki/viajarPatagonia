<?php

use Illuminate\Database\Seeder;

class DestinationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('destinations')->insert([
            'destination' => 'El Calafate',
            'fk_region' => 1
        ]);
        DB::table('destinations')->insert([
            'destination' => 'Chile Chico',
            'fk_region' => 2
        ]);        
    }
}
