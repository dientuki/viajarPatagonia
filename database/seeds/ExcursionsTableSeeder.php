<?php

use Illuminate\Database\Seeder;

class ExcursionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('excursions')->insert([
            'map' => 'https://www.google.com/maps/d/u/0/embed?mid=11i_O726xIp4gH7n6H9Di1-y8NTMqN30U',
            'is_active' => true,
            'fk_excursion_type' => '1',
            'fk_destination' => '1',
            'fk_duration' => '1',
            'fk_availability' => '1'
        ]);
        DB::table('excursions')->insert([
            'map' => 'https://www.google.com/maps/d/u/0/embed?mid=11i_O726xIp4gH7n6H9Di1-y8NTMqN30U',
            'is_active' => true,
            'fk_excursion_type' => '2',
            'fk_destination' => '2',
            'fk_duration' => '1',
            'fk_availability' => '1'
        ]);    
    }
}
