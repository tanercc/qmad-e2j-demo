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
            $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
            $table->integer("taskId");
            $table->string("taskName");
            $table->dateTime("startDate")->nullable();
            $table->dateTime("endDate")->nullable();
            $table->string("dependency")->nullable();
            $table->string("duration")->nullable();
            $table->string("durationUnit")->nullable();
            $table->string("progress")->nullable();
            $table->dateTime("baselineStartDate")->nullable();
            $table->dateTime("baselineEndDate")->nullable();
            $table->string("expandState")->nullable();
            $table->string("indicators")->nullable();
            $table->string("manual")->nullable();
            $table->string("milestone")->nullable();
            $table->string("notes")->nullable();
            $table->string("resourceInfo")->nullable();
            $table->integer("segmentId")->nullable();
            $table->string("segments")->nullable();
            $table->string("type")->nullable();
            $table->string("work")->nullable();
            $table->string("cssClass")->nullable();
            $table->integer("parentID")->nullable();
            $table->timestamps();

            $table->unique(['project_id', 'taskId']);
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
