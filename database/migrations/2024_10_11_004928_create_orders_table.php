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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_status_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('guest_user_id')->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('order_status_id')->references('id')->on('order_statuses');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('guest_user_id')->references('id')->on('guest_users');
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
