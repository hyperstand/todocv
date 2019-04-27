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
            $table->increments('id');
            $table->string('value');
            $table->boolean('finish');
            $table->integer('todo_id')->unsigned()->index()->nullable();
            $table->timestamps();
            $table->foreign('todo_id')->references('id')->on('todo')->onDelete('cascade');
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
