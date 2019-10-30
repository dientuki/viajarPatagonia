<?php

use Illuminate\Database\Seeder;

class Package2ExcursionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('package2excursion')->insert([
            'fk_package' => 1,
            'fk_excursion' => 1,
        ]);
        DB::table('package2excursion')->insert([
            'fk_package' => 2,
            'fk_excursion' => 2,
        ]);            
    }
}
