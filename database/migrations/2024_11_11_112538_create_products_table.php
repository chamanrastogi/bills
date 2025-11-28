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
        Schema::create('products', function (Blueprint $table) {
            $table->id('id');
            $table->integer('supplier_id')->nullable();
            $table->string('sku')->unique();
            $table->integer('type_id')->nullable();
            $table->string('name');
            $table->decimal('price', 12, 2)->nullable();
            $table->string('image')->nullable();
            $table->string('bill_image')->nullable();
            $table->integer('purity_id')->nullable(); // 22K, 18K
            $table->integer('unit_id')->nullable(); // gram, kg
            $table->decimal('gross_weight', 10, 4);
            $table->decimal('net_weight', 10, 4);
            $table->decimal('making_charge', 10, 2)->default(0);
            $table->decimal('rate_per_gram', 10, 2)->default(0);
            $table->decimal('gst_percent', 5, 2)->default(0);
            $table->decimal('stock_qty', 10, 4)->default(1);
            $table->enum('pstatus', ['in_stock', 'sold', 'returned'])->default('in_stock');
            $table->boolean('status')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
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
