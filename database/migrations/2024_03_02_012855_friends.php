<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Friends extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('friends', function (Blueprint $table) {
            $table->id();
            $table->boolean('deleted')->default(false);
            $table->unsignedBigInteger('user_sender_id')->unsigned();
            $table->unsignedBigInteger('ontvanger_id')->unsigned();
            $table->string('status');
            $table->foreign('user_sender_id')->references('id')->on('users');
            $table->foreign('ontvanger_id')->references('id')->on('users');
            $table->date('date_accepted');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('friends');
    }
}
