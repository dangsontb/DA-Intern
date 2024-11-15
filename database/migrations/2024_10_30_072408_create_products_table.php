<?php

use App\Models\Category;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Category::class)->constrained('categories');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('sku')->unique()->comment('Mã SKU duy nhất cho sản phẩm');
            $table->string('img_thumbnail')->nullable();
            $table->decimal('price_regular', 10,2);
            $table->decimal('price_sale',10,2)->nullable();
            $table->text('description')->nullable();
            $table->text('content')->nullable()->comment('Nội dung chi tiết của sản phẩm');
            $table->string('material')->nullable()->comment('Chất liệu');
            $table->boolean('is_active')->default(true);
            $table->boolean('is_hot_deal')->default(false);
            $table->boolean('is_good_deal')->default(false);
            $table->boolean('is_new')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
