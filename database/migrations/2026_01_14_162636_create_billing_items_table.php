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
        Schema::create('billing_items', function (Blueprint $table) {
            $table->id();

            // Reference only (NO foreign key)
            $table->unsignedBigInteger('billing_id');
            $table->unsignedBigInteger('product_id')->nullable();

            // Product snapshot
            $table->string('product_name');
            $table->decimal('gross_weight', 10, 4);
            $table->decimal('net_weight', 10, 4);
            $table->string('sku')->nullable();

            // Quantity & pricing
            $table->integer('quantity')->default(1);
            $table->decimal('price', 12, 2);
            $table->decimal('rate', 12, 2)->default(0);
            $table->decimal('making_charge', 12, 2)->default(0);

            // Tax
            $table->decimal('gst_percent', 5, 2)->default(0);
            $table->decimal('gst_amount', 12, 2)->default(0);

            // Final total
            $table->decimal('total_amount', 12, 2);

            $table->timestamps();

            // Indexes for performance (optional but recommended)
            $table->index('billing_id');
            $table->index('product_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billing_items');
    }
};
