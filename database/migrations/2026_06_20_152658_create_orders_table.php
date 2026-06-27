<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->string('order_name')->nullable();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->enum('payment_status', ['pending', 'paid', 'cancelled'])->default('paid');
            $table->enum('order_status', ['pending', 'completed', 'cancelled', 'ongoing'])->default('pending');
            $table->enum('payment_method', ['cash', 'qris'])->nullable();
            $table->decimal('total_amount', 12, 2)->default(0);
            $table->string('notes')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('created_at')->default(now());
            $table->timestamp('updated_at')->default(now());
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};