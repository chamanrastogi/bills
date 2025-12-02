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
        Schema::create('supplier_billings', function (Blueprint $table) {
            $table->id();
            $table->string('supplier_id')->nullable();
            $table->string('bill_image')->nullable();
            $table->integer('bill_amount')->default(0);
            $table->integer('paid')->default(0);
            $table->integer('payment_mode')->default(0);
            $table->string('transaction_id')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_billings');
    }
};
