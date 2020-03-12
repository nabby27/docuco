<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersBlockedDocumentsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('users_blocked_documents', function (Blueprint $table) {
      $table->timestamps();

      $table->unsignedInteger('document_id');
      $table->foreign('document_id')->references('id')->on('documents');
      $table->unsignedInteger('user_id');
      $table->foreign('user_id')->references('id')->on('users');

      $table->primary(['document_id', 'user_id']);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('users_blocked_documents');
  }
}
