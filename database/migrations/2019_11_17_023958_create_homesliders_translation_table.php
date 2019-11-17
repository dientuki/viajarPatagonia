<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomeslidersTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homesliders_translation', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';

            $table->tinyIncrements('id');
            $table->tinyInteger('fk_language')->unsigned();
            $table->tinyInteger('fk_homeslider')->unsigned();            
            $table->string('title');
            $table->string('date');
            $table->string('description');

            $table->foreign('fk_language')->references('id')->on('languages');
            $table->foreign('fk_homeslider')->references('id')->on('homesliders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('homesliders_translation');
    }
}
