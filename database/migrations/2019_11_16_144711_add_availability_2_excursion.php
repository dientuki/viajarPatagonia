<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAvailability2Excursion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('excursions', function (Blueprint $table) {
          $table->tinyInteger('fk_availability')->unsigned();

          $table->foreign('fk_availability')->references('id')->on('availability');       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('excursions', function (Blueprint $table) {
          $table->dropForeign('excursions_fk_availability_foreign');
          $table->dropColumn('fk_availability');
        });
    }
}
