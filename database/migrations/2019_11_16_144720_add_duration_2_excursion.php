<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDuration2Excursion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('excursions', function (Blueprint $table) {
          $table->tinyInteger('fk_duration')->unsigned();

          $table->foreign('fk_duration')->references('id')->on('duration');       
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
          $table->dropForeign('excursions_fk_duration_foreign');
          $table->dropColumn('fk_duration');
        });
    }
}
