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
        Schema::create('erp_inventory_stock_levels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('warehouse_id');
            $table->unsignedBigInteger('location_id')->nullable();
            $table->integer('quantity_on_hand');
            $table->integer('quantity_reserved')->default(0);
            $table->integer('quantity_available');
            $table->integer('reorder_point')->default(0);
            $table->integer('max_stock')->nullable();
            $table->decimal('average_cost', 10, 2)->nullable();
            $table->timestamp('last_movement_date')->nullable();
            $table->timestamps();

            $table->unique(['product_id', 'warehouse_id', 'location_id'], 'erp_stock_levels_unique');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('warehouse_id')->references('id')->on('erp_inventory_warehouses')->onDelete('cascade');
            $table->foreign('location_id')->references('id')->on('erp_inventory_locations')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('erp_inventory_stock_levels');
    }
}; 