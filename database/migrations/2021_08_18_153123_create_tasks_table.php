<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            // $table->foreignId('information_id');
            $table->foreignId('project_id');
            $table->text('name');
            $table->string('status');
            $table->text('notes')->nullable();
            $table->string('duedate')->nullable();
            $table->time('work_time');
            $table->time('billing')->nullable();
            $table->string('billed')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
