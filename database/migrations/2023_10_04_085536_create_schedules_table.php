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
            $table->int('day');
            $table->string('start');
            $table->string('end');
            $table->string('section')->nullable();
            $table->string('room')->nullable();
            $table->timestamps();

            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->foreign('user_id')->references('id')->on('users');
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
