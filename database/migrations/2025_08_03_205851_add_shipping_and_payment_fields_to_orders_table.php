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
        Schema::table('orders', function (Blueprint $table) {
            $table->text('shipping_address')->nullable()->after('total');
            $table->string('shipping_phone', 20)->nullable()->after('shipping_address');
            $table->enum('payment_method', ['card', 'cash_on_delivery'])->nullable()->after('shipping_phone');
            $table->string('order_number')->nullable()->after('payment_method');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['shipping_address', 'shipping_phone', 'payment_method', 'order_number']);
        });
    }
};
