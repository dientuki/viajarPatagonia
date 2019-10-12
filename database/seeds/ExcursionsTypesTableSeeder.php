<?php

use Illuminate\Database\Seeder;

class ExcursionsTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('excursions_types')->insert([
            'id' => 1,
        ]);
        DB::table('excursions_types')->insert([
            'id' => 2
        ]);     
    }
}
