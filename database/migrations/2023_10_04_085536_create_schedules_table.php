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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('teacher_subject_id')->unsigned();
            $table->integer('day');
            $table->string('start');
            $table->string('end');
            $table->string('section')->nullable();
            $table->string('room')->nullable();
            $table->timestamps();

            $table->foreign('teacher_subject_id')->references('id')->on('teacher_subjects');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
