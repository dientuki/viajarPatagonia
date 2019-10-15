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
            'name' => 'Patagonia es',
            'body' => '{"blocks":[{"key":"2eqog","text":"Cuerpo español","type":"unstyled","depth":0,"inlineStyleRanges":[{"offset":7,"length":7,"style":"BOLD"}],"entityRanges":[],"data":{}}],"entityMap":{}}',
            'summary' => 'bajada patagonia',
        ]);
        DB::table('cruiseships_translation')->insert([
            'fk_language' => 2,
            'fk_cruiseship' => 1,
            'name' => 'Patagonia en',
            'body' => '{"blocks":[{"key":"2eqog","text":"Cuerpo en","type":"unstyled","depth":0,"inlineStyleRanges":[{"offset":7,"length":2,"style":"BOLD"}],"entityRanges":[],"data":{}}],"entityMap":{}}',
            'summary' => 'summary patagonia',
        ]);
        DB::table('cruiseships_translation')->insert([
            'fk_language' => 3,
            'fk_cruiseship' => 1,
            'name' => 'Patagonia pt',
            'body' => '{"blocks":[{"key":"2eqog","text":"Cuerpo porugez","type":"unstyled","depth":0,"inlineStyleRanges":[{"offset":7,"length":7,"style":"ITALIC"}],"entityRanges":[],"data":{}}],"entityMap":{}}',
            'summary' => 'linha de queda patagonia',
        ]);
        DB::table('cruiseships_translation')->insert([
            'fk_language' => 1,
            'fk_cruiseship' => 2,
            'name' => 'Antartida es',
            'body' => '{"blocks":[{"key":"2eqog","text":"Cuerpo español","type":"unstyled","depth":0,"inlineStyleRanges":[{"offset":7,"length":7,"style":"BOLD"}],"entityRanges":[],"data":{}}],"entityMap":{}}',
            'summary' => 'bajada Antartida',            
        ]);
        DB::table('cruiseships_translation')->insert([
            'fk_language' => 2,
            'fk_cruiseship' => 2,
            'name' => 'Antartida en',
            'body' => '{"blocks":[{"key":"2eqog","text":"Cuerpo en","type":"unstyled","depth":0,"inlineStyleRanges":[{"offset":7,"length":2,"style":"BOLD"}],"entityRanges":[],"data":{}}],"entityMap":{}}',
            'summary' => 'summary Antartida',  
        ]);
        DB::table('cruiseships_translation')->insert([
            'fk_language' => 3,
            'fk_cruiseship' => 2,
            'name' => 'Antartida pt',
            'body' => '{"blocks":[{"key":"2eqog","text":"Cuerpo porugez","type":"unstyled","depth":0,"inlineStyleRanges":[{"offset":7,"length":7,"style":"ITALIC"}],"entityRanges":[],"data":{}}],"entityMap":{}}',
            'summary' => 'linha de queda Antartida',  
        ]);                  
    }
}
