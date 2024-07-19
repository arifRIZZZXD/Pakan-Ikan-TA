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
        Schema::create('feed_schedules', function (Blueprint $table) {
            $table->id();
            $table->integer('jam1');
            $table->integer('menit1');
            $table->integer('jam2');
            $table->integer('menit2');
            $table->integer('jam3');
            $table->integer('menit3');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feed_schedules');
    }
};

// KONTOLOGY BERJAMAAHH