<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('title', 200);
            $table->text('description');
            $table->unsignedBigInteger('project_id');
            $table->date('started_at')->useCurrent();
            $table->date('finished_at');
            $table->foreign('project_id')
            ->references('id')->on('projects')
            ->onDelete('cascade');
            $table->integer('manager_id');
            // $table->unsignedBigInteger('user_id');
            $table->foreignid('user_id')->constrained();
            $table->json('comments');
            $table->enum('priority', ['Низкий','Высокий','Средний']);
            $table->enum('status', ['Назначена','Выполняется','Завершена']);
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
};
