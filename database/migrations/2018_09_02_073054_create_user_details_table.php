<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->increments('user_detail_id'); 
            $table->string('first_name');
            $table->string('last_name'); 
            $table->string('phone', 15)->unique(); 
            $table->string('nid', 20)->unique(); 
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('user_id')->on('users');  
            $table->integer('division_id')->unsigned();
            $table->foreign('division_id')->references('division_id')->on('divisions');  
            $table->integer('district_id')->unsigned();
            $table->foreign('district_id')->references('district_id')->on('districts');  
            $table->integer('district_id')->unsigned();
            $table->foreign('district_id')->references('district_id')->on('districts');  
            $table->integer('thana_id')->unsigned();
            $table->foreign('thana_id')->references('thana_id')->on('thanas');
            $table->integer('zip_id')->unsigned();
            $table->foreign('zip_id')->references('zip_id')->on('zips');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_details');
    }
}
