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
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo', 100)->nullable();  // Logo column
            $table->string('favicon', 100)->nullable();  // Favicon column
            $table->string('site_title', 100);  // Site Title (required)
            $table->string('app_name', 100)->nullable();  // App Name column
            $table->string('support_phone', 50)->nullable();  // Support Phone column
            $table->string('email', 50)->nullable();  // Email column
            $table->integer('tax')->nullable();  // Tax column (integer)
            $table->string('address', 255)->nullable();  // Address column
            $table->string('gst', 255)->nullable();  // GST number column
            $table->string('bank_name', 100)->nullable();  // Bank Name column
            $table->string('bank_holder_name', 100)->nullable(); // Bank Holder Name column (required)
            $table->string('bank_ifsc', 50)->nullable();  // Bank IFSC code column (required)
            $table->string('bank_account', 100)->nullable();  // Bank Account column (required)
            $table->string('bank_branch', 100)->nullable(); // Bank Branch column (required)
            $table->string('pan_no', 100)->nullable(); // PAN Number column (required)
            $table->string('declaration', 255)->nullable(); // Declaration column (required)
            $table->string('message', 255)->nullable();  // Message column (required)
            $table->string('bank_qr_code', 255)->nullable();  // Bank QR Code column
            $table->string('payment_mode', 255)->nullable();  // Bank QR Code column
         });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
