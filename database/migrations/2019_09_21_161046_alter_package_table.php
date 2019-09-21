<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPackageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('packages', function ($table) {
            $table->smallInteger('fk_package2excursion')->unsigned();
            $table->smallInteger('fk_package2destination')->unsigned();

            $table->foreign('fk_package2excursion')->references('id')->on('package2excursion');
            $table->foreign('fk_package2destination')->references('id')->on('package2destination');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('packages', function ($table) {
            $table->dropForeign('packages_fk_package2excursion_foreign');
            $table->dropColumn('fk_package2excursion');

            $table->dropForeign('packages_fk_package2destination_foreign');
            $table->dropColumn('fk_package2destination');            
        });
    }
}
