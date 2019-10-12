<?php

use Illuminate\Database\Seeder;

class CruiseshipsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cruiseships')->insert([
            'map' => 'https://www.google.com/maps/d/u/0/embed?mid=11i_O726xIp4gH7n6H9Di1-y8NTMqN30U',
            'is_active' => true,
            'fk_cruiseship_type' => '1'
        ]);
        DB::table('cruiseships')->insert([
            'map' => 'https://www.google.com/maps/d/u/0/embed?mid=11i_O726xIp4gH7n6H9Di1-y8NTMqN30U',
            'is_active' => true,
            'fk_cruiseship_type' => '2'
        ]);    
    }
}
