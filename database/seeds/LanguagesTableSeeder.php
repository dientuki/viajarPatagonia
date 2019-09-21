<?php

use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->insert([
            'language' => 'Español',
            'iso' => 'es',
        ]);
        DB::table('languages')->insert([
            'language' => 'English',
            'iso' => 'en',
        ]);        
        DB::table('languages')->insert([
            'language' => 'Português',
            'iso' => 'pt',
        ]);    
    }
}
