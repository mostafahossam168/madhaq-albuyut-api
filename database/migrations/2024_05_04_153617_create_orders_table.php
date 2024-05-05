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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('payment_id')->constrained('payments')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('phone', 20);
            $table->text('address');
            $table->decimal('subtotal', 8, 2);
            $table->decimal('discount', 8, 2)->default(0);
            $table->decimal('total', 8, 2);
            $table->integer('status')->default(1); //pending ,cancel,confirm, complete,
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
