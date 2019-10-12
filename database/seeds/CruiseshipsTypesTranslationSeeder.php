<?php

use Illuminate\Database\Seeder;

class CruiseshipsTypesTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cruiseships_types_translation')->insert([
            'fk_language' => 1,
            'fk_cruiseship_type' => 1,
            'type' => 'Grandes Cruceros'
        ]);
        DB::table('cruiseships_types_translation')->insert([
            'fk_language' => 2,
            'fk_cruiseship_type' => 1,
            'type' => 'Great Cruises'
        ]);
        DB::table('cruiseships_types_translation')->insert([
            'fk_language' => 3,
            'fk_cruiseship_type' => 1,
            'type' => 'Grandes Cruzeiros'
        ]);
        DB::table('cruiseships_types_translation')->insert([
            'fk_language' => 1,
            'fk_cruiseship_type' => 2,
            'type' => 'Lacustres'
        ]);
        DB::table('cruiseships_types_translation')->insert([
            'fk_language' => 2,
            'fk_cruiseship_type' => 2,
            'type' => 'Lacustrine'
        ]);
        DB::table('cruiseships_types_translation')->insert([
            'fk_language' => 3,
            'fk_cruiseship_type' => 2,
            'type' => 'Lacustrine'
        ]);                  
    }
}
