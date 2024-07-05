<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('setting_datas', function (Blueprint $table) {
            $table->id();
            $table->decimal('tempMin');
            $table->decimal('tempMax');
            $table->decimal('phMin');
            $table->decimal('phMax');
            $table->decimal('feedMin');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('setting_datas');
    }
};
