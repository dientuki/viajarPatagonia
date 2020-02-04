<?php

use Illuminate\Database\Seeder;

class CruiseshipsPricesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cruiseships_prices')->insert([
            'fk_currency' => 3,
            'fk_cruiseship' => 1,
            'price' => '100',
            'discount' => '90',
            'is_active' => true,
        ]);
        DB::table('cruiseships_prices')->insert([
            'fk_currency' => 1,
            'fk_cruiseship' => 1,
            'price' => '6000',
            'discount' => '5000',
            'is_active' => true,
        ]);
        DB::table('cruiseships_prices')->insert([
            'fk_currency' => 3,
            'fk_cruiseship' => 2,
            'price' => '200',
            'discount' => '150',
            'is_active' => true,            
        ]);
        DB::table('cruiseships_prices')->insert([
            'fk_currency' => 1,
            'fk_cruiseship' => 2,
            'price' => '156000',
            'discount' => '13000',
            'is_active' => true,  
        ]);                 
    }
}
