<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Jhon Doe',
            'email' => 'dientuki@gmail.com',
            'password' => bcrypt('admin'),
        ]);
        DB::table('users')->insert([
            'name' => 'Devede Doe',
            'email' => 'devede@me.com',
            'password' => bcrypt('admin'),
        ]);
    }
}
