<?php

use Illuminate\Database\Seeder;

class PackagesTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('packages_translation')->insert([
            'fk_language' => 1,
            'fk_package' => 1,
            'name' => 'Patagonia paquete es',
            'body' => '{"blocks":[{"key":"2eqog","text":"Cuerpo español","type":"unstyled","depth":0,"inlineStyleRanges":[{"offset":7,"length":7,"style":"BOLD"}],"entityRanges":[],"data":{}}],"entityMap":{}}',
            'summary' => 'bajada patagonia',
        ]);
        DB::table('packages_translation')->insert([
            'fk_language' => 2,
            'fk_package' => 1,
            'name' => 'Patagonia paquete en',
            'body' => '{"blocks":[{"key":"2eqog","text":"Cuerpo en","type":"unstyled","depth":0,"inlineStyleRanges":[{"offset":7,"length":2,"style":"BOLD"}],"entityRanges":[],"data":{}}],"entityMap":{}}',
            'summary' => 'summary patagonia',
        ]);
        DB::table('packages_translation')->insert([
            'fk_language' => 3,
            'fk_package' => 1,
            'name' => 'Patagonia paquete pt',
            'body' => '{"blocks":[{"key":"2eqog","text":"Cuerpo porugez","type":"unstyled","depth":0,"inlineStyleRanges":[{"offset":7,"length":7,"style":"ITALIC"}],"entityRanges":[],"data":{}}],"entityMap":{}}',
            'summary' => 'linha de queda patagonia',
        ]);
        DB::table('packages_translation')->insert([
            'fk_language' => 1,
            'fk_package' => 2,
            'name' => 'Antartida paquete es',
            'body' => '{"blocks":[{"key":"2eqog","text":"Cuerpo español","type":"unstyled","depth":0,"inlineStyleRanges":[{"offset":7,"length":7,"style":"BOLD"}],"entityRanges":[],"data":{}}],"entityMap":{}}',
            'summary' => 'bajada Antartida excursion ',            
        ]);
        DB::table('packages_translation')->insert([
            'fk_language' => 2,
            'fk_package' => 2,
            'name' => 'Antartida paquete en',
            'body' => '{"blocks":[{"key":"2eqog","text":"Cuerpo en","type":"unstyled","depth":0,"inlineStyleRanges":[{"offset":7,"length":2,"style":"BOLD"}],"entityRanges":[],"data":{}}],"entityMap":{}}',
            'summary' => 'summary Antartida excursion ',  
        ]);
        DB::table('packages_translation')->insert([
            'fk_language' => 3,
            'fk_package' => 2,
            'name' => 'Antartida paquete pt',
            'body' => '{"blocks":[{"key":"2eqog","text":"Cuerpo porugez","type":"unstyled","depth":0,"inlineStyleRanges":[{"offset":7,"length":7,"style":"ITALIC"}],"entityRanges":[],"data":{}}],"entityMap":{}}',
            'summary' => 'linha de queda Antartida excursion ',  
        ]);                  
    }
}
