<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents_types', function (Blueprint $table) {
            $table->timestamps();

            $table->unsignedInteger('document_id');
            $table->foreign('document_id')->references('id')->on('documents');
            $table->unsignedInteger('type_id');
            $table->foreign('type_id')->references('id')->on('types');

            $table->primary(['document_id','type_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents_types');
    }
}
