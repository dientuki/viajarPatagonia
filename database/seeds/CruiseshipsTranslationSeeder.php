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
            'body' => '{"blocks":[{"key":"2eqog","text":"Cuerpo español","type":"unstyled","depth":0,"inlineStyleRanges":[{"offset":7,"length":7,"style":"BOLD"}],"entityRanges":[],"data":{}}],"entityMap":{}}',
            'dropline' => 'bajada patagonia',
        ]);
        DB::table('cruiseships_translation')->insert([
            'fk_language' => 2,
            'fk_cruiseship' => 1,
            'title' => 'Patagonia en',
            'body' => '{"blocks":[{"key":"2eqog","text":"Cuerpo en","type":"unstyled","depth":0,"inlineStyleRanges":[{"offset":7,"length":2,"style":"BOLD"}],"entityRanges":[],"data":{}}],"entityMap":{}}',
            'dropline' => 'dropline patagonia',
        ]);
        DB::table('cruiseships_translation')->insert([
            'fk_language' => 3,
            'fk_cruiseship' => 1,
            'title' => 'Patagonia pt',
            'body' => '{"blocks":[{"key":"2eqog","text":"Cuerpo porugez","type":"unstyled","depth":0,"inlineStyleRanges":[{"offset":7,"length":7,"style":"ITALIC"}],"entityRanges":[],"data":{}}],"entityMap":{}}',
            'dropline' => 'linha de queda patagonia',
        ]);
        DB::table('cruiseships_translation')->insert([
            'fk_language' => 1,
            'fk_cruiseship' => 2,
            'title' => 'Antartida es',
            'body' => '{"blocks":[{"key":"2eqog","text":"Cuerpo español","type":"unstyled","depth":0,"inlineStyleRanges":[{"offset":7,"length":7,"style":"BOLD"}],"entityRanges":[],"data":{}}],"entityMap":{}}',
            'dropline' => 'bajada Antartida',            
        ]);
        DB::table('cruiseships_translation')->insert([
            'fk_language' => 2,
            'fk_cruiseship' => 2,
            'title' => 'Antartida en',
            'body' => '{"blocks":[{"key":"2eqog","text":"Cuerpo en","type":"unstyled","depth":0,"inlineStyleRanges":[{"offset":7,"length":2,"style":"BOLD"}],"entityRanges":[],"data":{}}],"entityMap":{}}',
            'dropline' => 'dropline Antartida',  
        ]);
        DB::table('cruiseships_translation')->insert([
            'fk_language' => 3,
            'fk_cruiseship' => 2,
            'title' => 'Antartida pt',
            'body' => '{"blocks":[{"key":"2eqog","text":"Cuerpo porugez","type":"unstyled","depth":0,"inlineStyleRanges":[{"offset":7,"length":7,"style":"ITALIC"}],"entityRanges":[],"data":{}}],"entityMap":{}}',
            'dropline' => 'linha de queda Antartida',  
        ]);                  
    }
}
