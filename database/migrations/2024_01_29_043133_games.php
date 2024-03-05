<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Games extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('games', function (Blueprint $table) {
        $table->increments('id');
        $table->boolean('deleted')->default(false);
        $table->string('name');
        $table->string('link');
        $table->string('logo_file_path');
        $table->boolean('is_private');
        $table->unsignedBigInteger('user_id');
        $table->foreign('user_id')->references('id')->on('users');
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
    Schema::dropIfExists('games');
  }
}
