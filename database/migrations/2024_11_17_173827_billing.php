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
        Schema::create('billing', function (Blueprint $table) {
            $table->id('id');
            $table->string('cart', 500);
            $table->integer('discount');
            $table->string('discount_amount', 100);
            $table->integer('tax');
            $table->string('tax_amount', 100);
            $table->integer('gst');
            $table->integer('grand_total');
            $table->integer('payment');
            $table->integer('payment_mode')->default(0);
            $table->integer('transaction_no')->nullable();
            $table->integer('old_payment')->nullable();
            $table->integer('customer_id');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billing');
    }
};
