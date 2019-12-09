<?php

use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencies')->insert([
            'sign' => 'u$s',
            'iso' => 'USD',
            'currency' => 'United State dollar',
            'amount' => 1,
            'order' => 1
        ]);
        DB::table('currencies')->insert([
            'sign' => '€',
            'iso' => 'EUR',
            'currency' => 'Euro',
            'amount' => .91,
            'order' => 2
        ]);
        DB::table('currencies')->insert([
            'sign' => '$',
            'iso' => 'ARS',
            'currency' => 'Peso Argentino',
            'amount' => 59.69,
            'order' => 3
        ]);        
    }
}
