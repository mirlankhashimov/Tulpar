<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountryCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
//            $table->boolean('is_member_eeu');
//            $table->boolean('is_member_cis');
//            $table->boolean('is_developing_country');
//            $table->boolean('is_developed_country');
//            $table->integer('country_id')->unsigned();
         //   $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            //$table->timestamps();
        });
//        Schema::table('categories', function($table) {
//            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
//        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
