<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageReceipientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_receipients', function (Blueprint $table) {
            $table->increments('message_receipient_id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->integer('message_subject_id')->unsigned();
            $table->foreign('message_subject_id')->references('message_subject_id')->on('message_subjects');
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
        Schema::dropIfExists('message_receipients');
    }
}
