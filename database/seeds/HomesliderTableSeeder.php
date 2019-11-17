<?php

use Illuminate\Database\Seeder;

class HomesliderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('homeslider')->insert([
            'is_active' => true,
            'url' => 'http://www.ciudad.com.ar',
            'hotel' => 'Las leñas',
            'stars' => '4',
            'order' => 1
        ]);
        DB::table('homeslider')->insert([
            'is_active' => false,
            'url' => 'http://www.ciudad.com.ar',
            'hotel' => 'Las casitas',
            'stars' => '2',
            'order' => 3
        ]);  
        DB::table('homeslider')->insert([
            'is_active' => false,
            'url' => 'http://www.ciudad.com.ar',
            'hotel' => 'Las casitas',
            'stars' => '2',
            'order' => 2
        ]);           
    }
}
