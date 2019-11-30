<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDurationTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('duration_translation', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';

            $table->smallIncrements('id');
            $table->tinyInteger('fk_language')->unsigned();
            $table->tinyInteger('fk_duration')->unsigned();
            $table->string('duration', 190);

            $table->foreign('fk_language')->references('id')->on('languages');
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
        Schema::dropIfExists('duration_translation');
    }
}
