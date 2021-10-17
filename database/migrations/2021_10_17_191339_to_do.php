<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ToDo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //to Do list for employees
        Schema::create('todos', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('title');
            $table->text('detail');
            $table->boolean('state')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('employee_todo', function (Blueprint $table) {
            $table->bigInteger('employee_id')->unsigned();
            $table->foreign('employee_id')->references('id')->on('employees')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('todo_id')->unsigned();
            $table->foreign('todo_id')->references('id')->on('todos')->onUpdate('cascade')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('todos');
    }
}
