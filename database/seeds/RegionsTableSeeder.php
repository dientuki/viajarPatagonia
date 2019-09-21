<?php

use Illuminate\Database\Seeder;

class RegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('regions')->insert([
            'id' => 1,
            'region' => 'Patagonia Austral'
        ]);
        DB::table('regions')->insert([
            'id' => 2,
            'region' => 'Patagonia Chilena'
        ]);
        DB::table('regions')->insert([
            'id' => 3,
            'region' => 'Patagonia Austral'
        ]);
        DB::table('regions')->insert([
            'id' => 4,
            'region' => 'Patagonia en Bus'
        ]);
        DB::table('regions')->insert([
            'id' => 5,
            'region' => 'Patagonia Las Playas'
        ]);
        DB::table('regions')->insert([
            'id' => 6,
            'region' => 'Patagonia Los Lagos'
        ]);                                        
    }
}
