<?php

use App\Models\Order;
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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Order::class)->constrained();
            $table->decimal('amount', 15, 2);
            $table->string('transaction_id')->nullable();
            $table->enum('payment_method', ['momo', 'vnpay', 'cod']);
            $table->enum('status', ['Pending', 'Completed', 'Failed', 'Refunded'])->default('Pending');
            $table->string('currency', 3)->default('VND');
            $table->timestamp('payment_date')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
