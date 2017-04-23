<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldSetUtamaAtProductHasGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_has_galleries', function(Blueprint $table){

            $table->integer('set_utama')->nullable()->default('0')->after('galleries_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_has_galleries', function(Blueprint $table){

            $table->dropColumn('set_utama');

        });
    }
}
