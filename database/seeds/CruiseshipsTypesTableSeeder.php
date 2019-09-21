<?php

use Illuminate\Database\Seeder;

class CruiseshipsTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cruiseships_types')->insert([
            'id' => 1,
        ]);
        DB::table('cruiseships_types')->insert([
            'id' => 2
        ]);     
    }
}
