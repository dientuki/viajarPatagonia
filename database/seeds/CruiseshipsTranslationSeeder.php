<?php

use Illuminate\Database\Seeder;

class CruiseshipsTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cruiseships_translation')->insert([
            'fk_language' => 1,
            'fk_cruiseship' => 1,
            'title' => 'Patagonia es',
            'body' => 'cuerpo patagonia',
            'dropline' => 'bajada patagonia',
        ]);
        DB::table('cruiseships_translation')->insert([
            'fk_language' => 2,
            'fk_cruiseship' => 1,
            'title' => 'Patagonia en',
            'body' => 'body patagonia',
            'dropline' => 'dropline patagonia',
        ]);
        DB::table('cruiseships_translation')->insert([
            'fk_language' => 3,
            'fk_cruiseship' => 1,
            'title' => 'Patagonia pt',
            'body' => 'corpo patagonia',
            'dropline' => 'linha de queda patagonia',
        ]);
        DB::table('cruiseships_translation')->insert([
            'fk_language' => 1,
            'fk_cruiseship' => 2,
            'title' => 'Antartida es',
            'body' => 'cuerpo Antartida',
            'dropline' => 'bajada Antartida',            
        ]);
        DB::table('cruiseships_translation')->insert([
            'fk_language' => 2,
            'fk_cruiseship' => 2,
            'title' => 'Antartida en',
            'body' => 'body Antartida',
            'dropline' => 'dropline Antartida',  
        ]);
        DB::table('cruiseships_translation')->insert([
            'fk_language' => 3,
            'fk_cruiseship' => 2,
            'title' => 'Antartida pt',
            'body' => 'corpo Antartida',
            'dropline' => 'linha de queda Antartida',  
        ]);                  
    }
}
