<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable(true);
            $table->longText('description')->nullable(true);
            $table->float('price', 8, 3)->nullable(true);
            $table->string('url');
            $table->date('date_of_issue')->default(date("Y-m-d H:i:s"));
            $table->timestamps();

            $table->unsignedInteger('user_group_id');
            $table->foreign('user_group_id')->references('id')->on('user_groups');
            $table->unsignedInteger('type_id');
            $table->foreign('type_id')->references('id')->on('types');
        });
    }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
    public function down()
    {
        Schema::dropIfExists('documents');
    }
}
