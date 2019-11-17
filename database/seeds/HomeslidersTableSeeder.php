<?php

use Illuminate\Database\Seeder;

class HomeslidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('homesliders')->insert([
            'is_active' => true,
            'url' => 'http://www.ciudad.com.ar',
            'hotel' => 'Las leñas',
            'stars' => '4'
        ]);
        DB::table('homesliders')->insert([
            'is_active' => false,
            'url' => 'http://www.ciudad.com.ar',
            'hotel' => 'Las casitas',
            'stars' => '2'
        ]);    
    }
}
