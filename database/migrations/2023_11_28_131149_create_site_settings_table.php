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
            $table->string('logo',100)->nullable();
            $table->string('favicon',100)->nullable();
            $table->string('site_title', 20);
            $table->string('app_name', 20)->nullable();
            $table->string('support_phone', 50)->nullable();
            $table->string('email', 50)->nullable();
            $table->integer('tax')->define(6);
            $table->string('address', 255)->nullable();
            $table->string('gst', 100)->nullable();
            $table->string('bank_name', 100)->nullable();
            $table->string('bank_account', 100)->nullable();
            $table->string('bank_branch', 150)->nullable();
            $table->string('pan_no', 50)->nullable();
            $table->string('other', 100)->nullable();
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
