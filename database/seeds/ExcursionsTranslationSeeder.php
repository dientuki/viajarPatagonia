<?php

use Illuminate\Database\Seeder;

class ExcursionsTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('excursions_translation')->insert([
            'fk_language' => 1,
            'fk_excursion' => 1,
            'name' => 'Patagonia excursion  es',
            'body' => '{"blocks":[{"key":"2eqog","text":"Cuerpo español","type":"unstyled","depth":0,"inlineStyleRanges":[{"offset":7,"length":7,"style":"BOLD"}],"entityRanges":[],"data":{}}],"entityMap":{}}',
            'summary' => 'bajada patagonia',
        ]);
        DB::table('excursions_translation')->insert([
            'fk_language' => 2,
            'fk_excursion' => 1,
            'name' => 'Patagonia excursion  en',
            'body' => '{"blocks":[{"key":"2eqog","text":"Cuerpo en","type":"unstyled","depth":0,"inlineStyleRanges":[{"offset":7,"length":2,"style":"BOLD"}],"entityRanges":[],"data":{}}],"entityMap":{}}',
            'summary' => 'summary patagonia',
        ]);
        DB::table('excursions_translation')->insert([
            'fk_language' => 3,
            'fk_excursion' => 1,
            'name' => 'Patagonia excursion  pt',
            'body' => '{"blocks":[{"key":"2eqog","text":"Cuerpo porugez","type":"unstyled","depth":0,"inlineStyleRanges":[{"offset":7,"length":7,"style":"ITALIC"}],"entityRanges":[],"data":{}}],"entityMap":{}}',
            'summary' => 'linha de queda patagonia',
        ]);
        DB::table('excursions_translation')->insert([
            'fk_language' => 1,
            'fk_excursion' => 2,
            'name' => 'Antartida excursion  es',
            'body' => '{"blocks":[{"key":"2eqog","text":"Cuerpo español","type":"unstyled","depth":0,"inlineStyleRanges":[{"offset":7,"length":7,"style":"BOLD"}],"entityRanges":[],"data":{}}],"entityMap":{}}',
            'summary' => 'bajada Antartida excursion ',            
        ]);
        DB::table('excursions_translation')->insert([
            'fk_language' => 2,
            'fk_excursion' => 2,
            'name' => 'Antartida excursion  en',
            'body' => '{"blocks":[{"key":"2eqog","text":"Cuerpo en","type":"unstyled","depth":0,"inlineStyleRanges":[{"offset":7,"length":2,"style":"BOLD"}],"entityRanges":[],"data":{}}],"entityMap":{}}',
            'summary' => 'summary Antartida excursion ',  
        ]);
        DB::table('excursions_translation')->insert([
            'fk_language' => 3,
            'fk_excursion' => 2,
            'name' => 'Antartida excursion  pt',
            'body' => '{"blocks":[{"key":"2eqog","text":"Cuerpo porugez","type":"unstyled","depth":0,"inlineStyleRanges":[{"offset":7,"length":7,"style":"ITALIC"}],"entityRanges":[],"data":{}}],"entityMap":{}}',
            'summary' => 'linha de queda Antartida excursion ',  
        ]);                  
    }
}
