<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCruiseshipsTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cruiseships_tranlation', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';

            $table->smallIncrements('id');
            $table->tinyInteger('fk_language')->unsigned();
            $table->smallInteger('fk_cruiseships')->unsigned();
            $table->string('title');
            $table->string('body');
            $table->string('dropline');

            $table->foreign('fk_language')->references('id')->on('languages');
            $table->foreign('fk_cruiseships')->references('id')->on('cruiseships');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cruiseships_tranlation');
    }
}