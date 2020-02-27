<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersBlockedTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_blocked_types', function (Blueprint $table) {
            $table->timestamps();

            $table->unsignedInteger('type_id');
            $table->foreign('type_id')->references('id')->on('types');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            
            $table->primary(['type_id','user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_blocked_types');
    }
}
