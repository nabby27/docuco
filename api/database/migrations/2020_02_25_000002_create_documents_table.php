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
            $table->float('price')->nullable(true);
            $table->string('url');
            $table->date('dateOfIssue')->default(date("Y-m-d H:i:s"));
            $table->timestamps();

            $table->unsignedInteger('users_group_id');
            $table->foreign('users_group_id')->references('id')->on('users_groups');
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
