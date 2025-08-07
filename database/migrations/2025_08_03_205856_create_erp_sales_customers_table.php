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
        Schema::create('erp_sales_customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_code')->unique();
            $table->string('company_name')->nullable();
            $table->string('contact_name');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->string('city');
            $table->string('state')->nullable();
            $table->string('country');
            $table->string('postal_code');
            $table->string('tax_number')->nullable();
            $table->decimal('credit_limit', 12, 2)->default(0);
            $table->integer('payment_terms_days')->default(30);
            $table->enum('customer_type', ['individual', 'business', 'healthcare'])->default('individual');
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active');
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('assigned_sales_rep')->nullable();
            $table->timestamps();

            $table->foreign('assigned_sales_rep')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('erp_sales_customers');
    }
}; 