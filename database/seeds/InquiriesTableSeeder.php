<?php

use App\Inquiry;
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
      factory(Inquiry::class, 50)->create()->each(function ($inquiry) {
        $values = factory(Inquiry::class)->make();

        if (is_array($values)) {
          $inquiry->save($values);
        }
        
      });      
    }
}
