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
        Schema::create('erp_purchases_suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('supplier_code')->unique();
            $table->string('company_name');
            $table->string('contact_name');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->string('city');
            $table->string('state')->nullable();
            $table->string('country');
            $table->string('postal_code');
            $table->string('tax_number')->nullable();
            $table->string('website')->nullable();
            $table->decimal('credit_limit', 12, 2)->default(0);
            $table->integer('payment_terms_days')->default(30);
            $table->enum('supplier_type', ['manufacturer', 'distributor', 'wholesaler', 'service'])->default('distributor');
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active');
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('assigned_buyer')->nullable();
            $table->timestamps();

            $table->foreign('assigned_buyer')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('erp_purchases_suppliers');
    }
}; 