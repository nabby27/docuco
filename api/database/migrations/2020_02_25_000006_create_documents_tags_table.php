<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTagsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
    public function up()
    {
        Schema::create('documents_tags', function (Blueprint $table) {
            $table->timestamps();

            $table->unsignedInteger('document_id');
            $table->foreign('document_id')->references('id')->on('documents');
            $table->unsignedInteger('tag_id');
            $table->foreign('tag_id')->references('id')->on('tags');

            $table->primary(['document_id', 'tag_id']);
        });
    }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
    public function down()
    {
        Schema::dropIfExists('documents_tags');
    }
}
