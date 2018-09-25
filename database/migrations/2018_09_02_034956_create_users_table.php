<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id');
            $table->tinyInteger('parent_id')->default(0);
            $table->string('first_name');
            $table->string('last_name'); 
            $table->string('email')->unique();
            $table->string('active_session_id')->nullable();
            $table->timestamp('last_login_time')->nullable();
            $table->timestamp('last_logout_time')->nullable();
            $table->string('username')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->integer('role_id')->unsigned();
            $table->foreign('role_id')->references('role_id')->on('roles');  
            $table->enum('status', ['active','inactive','pending','deleted'])->default('pending'); 
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
        Schema::dropIfExists('users');
    }
}
