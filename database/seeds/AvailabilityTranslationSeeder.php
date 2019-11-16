<?php

use Illuminate\Database\Seeder;

class AvailabilityTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('availability_translation')->insert([
            'fk_language' => 1,
            'fk_availability' => 1,
            'availability' => 'Todo el año'
        ]);
        DB::table('availability_translation')->insert([
            'fk_language' => 2,
            'fk_availability' => 1,
            'availability' => 'All year'
        ]);
        DB::table('availability_translation')->insert([
            'fk_language' => 3,
            'fk_availability' => 1,
            'availability' => 'Todo o ano'
        ]);
        DB::table('availability_translation')->insert([
            'fk_language' => 1,
            'fk_availability' => 2,
            'availability' => 'Junio a Octubre'
        ]);
        DB::table('availability_translation')->insert([
            'fk_language' => 2,
            'fk_availability' => 2,
            'availability' => 'Juny to October'
        ]);
        DB::table('availability_translation')->insert([
            'fk_language' => 3,
            'fk_availability' => 2,
            'availability' => 'Junho a outubro'
        ]);                  
    }
}
