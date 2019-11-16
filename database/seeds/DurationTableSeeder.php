<?php

use Illuminate\Database\Seeder;

class DurationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('duration')->insert([
            'id' => 1,
        ]);
        DB::table('duration')->insert([
            'id' => 2
        ]);     
    }
}
