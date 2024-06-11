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
        Schema::create('protocols', function (Blueprint $table) {
            $table->id();
            $table->time('start_time');  // в колко часа започва
            $table->integer('meetQuorum1');     // кворум час 1: % и час
            $table->integer('meetQuorum2');     // кворум час 2: % и час
            $table->string('minuteman')->nullable();        // име протоколчик
            $table->time('end_time');    // в колко часа завършва
            $table->text('notes')->nullable();              // текст приложения
            $table->foreignId('invitation_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('protocols');
    }
};
