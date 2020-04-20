<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->text('embed')->nullable();
            $table->boolean('add_contact_form')->unsigned()->default(false);
            $table->boolean('in_header')->unsigned()->default(false);
            $table->boolean('in_footer')->unsigned()->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('embed');
            $table->dropColumn('add_contact_form');
            $table->dropColumn('in_header');
            $table->dropColumn('in_footer');
        });
    }
}
