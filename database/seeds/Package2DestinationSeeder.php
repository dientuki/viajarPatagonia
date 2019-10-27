<?php

use Illuminate\Database\Seeder;

class Package2DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('package2destination')->insert([
            'fk_package' => 1,
            'fk_destination' => 1,
        ]);
        DB::table('package2destination')->insert([
            'fk_package' => 2,
            'fk_destination' => 1,
        ]);    
        DB::table('package2destination')->insert([
            'fk_package' => 2,
            'fk_destination' => 2,
        ]);            
    }
}
