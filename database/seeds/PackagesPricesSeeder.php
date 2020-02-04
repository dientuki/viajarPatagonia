<?php

use Illuminate\Database\Seeder;

class PackagesPricesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('packages_prices')->insert([
            'fk_currency' => 3,
            'fk_package' => 1,
            'price' => '100',
            'discount' => '90',
            'is_active' => true,
        ]);
        DB::table('packages_prices')->insert([
            'fk_currency' => 1,
            'fk_package' => 1,
            'price' => '6000',
            'discount' => '5000',
            'is_active' => true,
        ]);
        DB::table('packages_prices')->insert([
            'fk_currency' => 3,
            'fk_package' => 2,
            'price' => '200',
            'discount' => '150',
            'is_active' => true,            
        ]);
        DB::table('packages_prices')->insert([
            'fk_currency' => 1,
            'fk_package' => 2,
            'price' => '156000',
            'discount' => '13000',
            'is_active' => true,  
        ]);                 
    }
}
