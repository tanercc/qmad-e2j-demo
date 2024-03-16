<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id');
            $table->integer("TaskId");
            $table->string("TaskName");
            $table->dateTime("StartDate")->nullable();
            $table->dateTime("EndDate")->nullable();
            $table->tinyInteger("TimeLog")->nullable();
            $table->tinyInteger("Work")->nullable();
            $table->tinyInteger("Progress")->nullable();
            $table->string("Status")->nullable();
            $table->integer("ParentId")->nullable();
            $table->json("Assignee")->nullable();
            $table->string("Priority")->nullable();
            $table->string("Component")->nullable();
            $table->string("Predecessor")->nullable();
            $table->tinyInteger("StoryPoints")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
