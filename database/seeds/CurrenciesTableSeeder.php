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
            'code' => 'USD',
            'currency' => 'United State dollar',
            'amount' => 1
        ]);
        DB::table('currencies')->insert([
            'sign' => '€',
            'code' => 'EUR',
            'currency' => 'Euro',
            'amount' => .91
        ]);
        DB::table('currencies')->insert([
            'sign' => '$',
            'code' => 'ARS',
            'currency' => 'Peso Argentino',
            'amount' => 59.69
        ]);        
    }
}
