<?php

use Illuminate\Database\Seeder;

class ExcursionsTypesTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('excursions_types_translation')->insert([
            'fk_language' => 1,
            'fk_excursion_type' => 1,
            'type' => 'Clasicas'
        ]);
        DB::table('excursions_types_translation')->insert([
            'fk_language' => 2,
            'fk_excursion_type' => 1,
            'type' => 'Classics'
        ]);
        DB::table('excursions_types_translation')->insert([
            'fk_language' => 3,
            'fk_excursion_type' => 1,
            'type' => 'Clássicas'
        ]);
        DB::table('excursions_types_translation')->insert([
            'fk_language' => 1,
            'fk_excursion_type' => 2,
            'type' => 'Lacustres'
        ]);
        DB::table('excursions_types_translation')->insert([
            'fk_language' => 2,
            'fk_excursion_type' => 2,
            'type' => 'Lacustrine'
        ]);
        DB::table('excursions_types_translation')->insert([
            'fk_language' => 3,
            'fk_excursion_type' => 2,
            'type' => 'Lacustrine'
        ]);                  
    }
}
