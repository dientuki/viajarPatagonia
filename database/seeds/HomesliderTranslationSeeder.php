<?php

use Illuminate\Database\Seeder;

class HomesliderTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('homeslider_translation')->insert([
            'fk_language' => 1,
            'fk_slider' => 1,
            'title' => 'Patagonia excursion  es',
            'date' => 'Salida',
            'description' => 'bajada patagonia',
        ]);
        DB::table('homeslider_translation')->insert([
            'fk_language' => 2,
            'fk_slider' => 1,
            'title' => 'Patagonia excursion  en',
            'date' => 'Salida',
            'description' => 'description patagonia',
        ]);
        DB::table('homeslider_translation')->insert([
            'fk_language' => 3,
            'fk_slider' => 1,
            'title' => 'Patagonia excursion  pt',
            'date' => 'Salida',
            'description' => 'linha de queda patagonia',
        ]);
        DB::table('homeslider_translation')->insert([
            'fk_language' => 1,
            'fk_slider' => 2,
            'title' => 'Antartida excursion  es',
            'date' => 'Salida',
            'description' => 'bajada Antartida excursion ',            
        ]);
        DB::table('homeslider_translation')->insert([
            'fk_language' => 2,
            'fk_slider' => 2,
            'title' => 'Antartida excursion  en',
            'date' => 'Salida',
            'description' => 'description Antartida excursion ',  
        ]);
        DB::table('homeslider_translation')->insert([
            'fk_language' => 3,
            'fk_slider' => 2,
            'title' => 'Antartida excursion  pt',
            'date' => 'Salida',
            'description' => 'linha de queda Antartida excursion ',  
        ]);   
        DB::table('homeslider_translation')->insert([
            'fk_language' => 1,
            'fk_slider' => 3,
            'title' => '3 Antartida excursion  es',
            'date' => 'Salida',
            'description' => 'bajada Antartida excursion ',            
        ]);
        DB::table('homeslider_translation')->insert([
            'fk_language' => 2,
            'fk_slider' => 3,
            'title' => '3 Antartida excursion  en',
            'date' => 'Salida',
            'description' => 'description Antartida excursion ',  
        ]);
        DB::table('homeslider_translation')->insert([
            'fk_language' => 3,
            'fk_slider' => 3,
            'title' => '3 Antartida excursion  pt',
            'date' => 'Salida',
            'description' => 'linha de queda Antartida excursion ',  
        ]);                       
    }
}
