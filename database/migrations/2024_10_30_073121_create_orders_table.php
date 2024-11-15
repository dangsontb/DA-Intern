<?php

use App\Models\Order;
use App\Models\User;
use App\Models\Voucher;
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

            // user id chỉ dùng để xác định nó là thằng người dùng nào trên hệ thống
            $table->foreignIdFor(User::class)->constrained();
            $table->foreignIdFor(Voucher::class)->nullable()->constrained()->onDelete('set null');

            // Lưu lại toàn bộ thông tin của người đặt hàng
            $table->string('user_name');
            $table->string('user_email');
            $table->string('user_phone');
            $table->string('user_address');
            $table->string('user_note')->nullable();

            $table->boolean('is_ship_user_same_user')->default(true);

            // Lưu lại toàn bộ thông tin của người nhận hàng
            $table->string('ship_user_name')->nullable();
            $table->string('ship_user_email')->nullable();
            $table->string('ship_user_phone')->nullable();
            $table->string('ship_user_address')->nullable();
            $table->string('ship_user_note')->nullable();

            $table->string('status_order')->default(Order::STATUS_ORDER_PENDING);
            $table->enum('status_payment', ['Chưa thanh toán', 'Đã thanh toán']);

            $table->decimal('total_price', 12, 2);

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
