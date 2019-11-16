<?php

use Illuminate\Database\Seeder;

class DurationTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('duration_translation')->insert([
            'fk_language' => 1,
            'fk_duration' => 1,
            'duration' => 'Dia completo'
        ]);
        DB::table('duration_translation')->insert([
            'fk_language' => 2,
            'fk_duration' => 1,
            'duration' => 'All day'
        ]);
        DB::table('duration_translation')->insert([
            'fk_language' => 3,
            'fk_duration' => 1,
            'duration' => 'dia todo'
        ]);
        DB::table('duration_translation')->insert([
            'fk_language' => 1,
            'fk_duration' => 2,
            'duration' => 'medio dia'
        ]);
        DB::table('duration_translation')->insert([
            'fk_language' => 2,
            'fk_duration' => 2,
            'duration' => 'half day'
        ]);
        DB::table('duration_translation')->insert([
            'fk_language' => 3,
            'fk_duration' => 2,
            'duration' => 'meio dia'
        ]);                  
    }
}
