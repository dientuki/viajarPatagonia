<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inquiries', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';

            $table->bigIncrements('id');
            $table->string('name', 190);
            $table->timestampTz('timestamp');
            $table->string('email', 190);
            $table->string('phone', 190);
            $table->date('departure');
            $table->tinyInteger('adult')->unsigned()->default(0);
            $table->tinyInteger('child')->unsigned()->default(0);
            $table->text('comment');
            $table->enum('product', ['cruise', 'excursion', 'package']);
            $table->smallInteger('product_id')->unsigned();
            $table->tinyInteger('fk_language')->unsigned();
            $table->boolean('is_readed')->unsigned()->default(false);

            $table->foreign('fk_language')->references('id')->on('languages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inquiries');
    }
}
