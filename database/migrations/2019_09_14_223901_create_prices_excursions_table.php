<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePricesExcursionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prices_excursions', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';

            $table->smallIncrements('id');
            $table->mediumInteger('price')->unsigned();
            $table->mediumInteger('discount')->unsigned()->nullable(true);
            $table->boolean('is_active')->unsigned()->default(false);
            $table->tinyInteger('fk_currency')->unsigned();
            $table->smallInteger('fk_excursion')->unsigned();

            $table->foreign('fk_currency')->references('id')->on('currencies');
            $table->foreign('fk_excursion')->references('id')->on('excursions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prices_excursions');
    }
}
