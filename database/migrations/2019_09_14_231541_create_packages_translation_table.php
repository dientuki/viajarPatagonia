<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagesTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages_translation', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';

            $table->smallIncrements('id');
            $table->tinyInteger('fk_language')->unsigned();
            $table->smallInteger('fk_package')->unsigned();
            $table->string('name', 190);
            $table->text('summary');
            $table->mediumText('body');

            $table->foreign('fk_language')->references('id')->on('languages');
            $table->foreign('fk_package')->references('id')->on('packages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('packages_translation');
    }
}
