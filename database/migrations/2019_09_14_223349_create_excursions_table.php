<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExcursionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('excursions', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';

            $table->smallIncrements('id');
            $table->text('map')->nullable(true);
            $table->boolean('is_active')->unsigned()->default(false);
            $table->tinyInteger('fk_excursion_type')->unsigned();
            $table->tinyInteger('fk_destination')->unsigned();

            $table->foreign('fk_excursion_type')->references('id')->on('excursions_types');
            $table->foreign('fk_destination')->references('id')->on('destinations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('excursions');
    }
}
