<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersBlockedTagsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('users_blocked_tags', function (Blueprint $table) {
      $table->timestamps();

      $table->unsignedInteger('tag_id');
      $table->foreign('tag_id')->references('id')->on('tags');
      $table->unsignedInteger('user_id');
      $table->foreign('user_id')->references('id')->on('users');

      $table->primary(['tag_id', 'user_id']);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('users_blocked_tags');
  }
}
