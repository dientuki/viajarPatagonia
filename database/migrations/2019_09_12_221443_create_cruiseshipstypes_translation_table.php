<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCruiseshipsTypesTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cruiseships_types_translation', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';

            $table->smallIncrements('id');
            $table->tinyInteger('fk_language')->unsigned();
            $table->tinyInteger('fk_cruiseship_type')->unsigned();
            $table->string('type', 190);

            $table->foreign('fk_language')->references('id')->on('languages');
            $table->foreign('fk_cruiseship_type')->references('id')->on('cruiseships_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cruiseships_types_translation');
    }
}
