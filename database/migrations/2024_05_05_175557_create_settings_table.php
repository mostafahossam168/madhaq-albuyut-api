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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo');
            $table->string('text1');
            $table->string('image1');
            $table->string('text2');
            $table->string('image2');
            $table->string('text3');
            $table->string('image3');
            $table->string('f_link');
            $table->string('i_link');
            $table->string('t_link');
            $table->string('email', 50);
            $table->string('phone', 20);
            $table->text('conditions');
            $table->text('policy');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
