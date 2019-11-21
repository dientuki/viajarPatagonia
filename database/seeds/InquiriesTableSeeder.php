<?php

use Illuminate\Database\Seeder;

class InquiriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('inquiries')->insert([
            'name' => 'Juan Perez',
            'email' => 'email@mail.com',
            'phone' => '+549123456789',
            'departure' => '2019-12-31',
            'adult' => 1,
            'child' => 0,
            'comments' => 'la consulta',
            'product' => 'excursions',
            'product_id' => 1,
            'fk_language' => 3,
            'is_readed' => 0
        ]);

        DB::table('inquiries')->insert([
            'name' => 'Juan Perez',
            'email' => 'email@mail.com',
            'phone' => '+549123456789',
            'departure' => '2019-12-31',
            'adult' => 1,
            'child' => 1,
            'comments' => 'la consulta',
            'product' => 'packages',
            'product_id' => 1,
            'fk_language' => 1,
            'is_readed' => 0
        ]);

        DB::table('inquiries')->insert([
            'name' => 'Juan Perez',
            'email' => 'email@mail.com',
            'phone' => '+549123456789',
            'departure' => '2019-12-31',
            'adult' => 1,
            'child' => 2,
            'comments' => 'la consulta',
            'product' => 'cruiseships',
            'product_id' => 1,
            'fk_language' => 2,
            'is_readed' => 0
        ]);              
    }
}
