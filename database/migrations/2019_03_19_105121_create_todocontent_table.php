<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTodocontentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todocontent', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('todo_id')->unsigned()->index()->nullable();
            $table->boolean('value');
            $table->timestamps();
            $table->foreign('todo_id')->references('id')->on('todo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('todocontent');
    }
}
