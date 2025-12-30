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
        Schema::create('supplier_billing_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_billing_id')
                ->constrained('supplier_billings')
                ->onDelete('cascade');
            $table->foreignId('product_id')
                ->constrained('products')
                ->cascadeOnDelete();
            $table->decimal('total_weight', 10, 3)->default(0);
            $table->decimal('rate_per_gram', 10, 2)->default(0);
            $table->decimal('line_total', 12, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_billing_items');
    }
};

