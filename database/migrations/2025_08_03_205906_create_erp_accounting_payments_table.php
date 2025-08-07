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
        Schema::create('erp_accounting_payments', function (Blueprint $table) {
            $table->id();
            $table->string('payment_number')->unique();
            $table->date('payment_date');
            $table->enum('payment_type', ['customer_payment', 'supplier_payment', 'expense_payment']);
            $table->enum('payment_method', ['cash', 'check', 'bank_transfer', 'credit_card', 'online'])->default('bank_transfer');
            $table->decimal('amount', 12, 2);
            $table->string('reference_number')->nullable(); // Numéro de chèque, transaction, etc.
            $table->text('description')->nullable();
            $table->enum('status', ['draft', 'posted', 'cancelled'])->default('draft');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->unsignedBigInteger('invoice_id')->nullable(); // Lien avec facture de vente
            $table->unsignedBigInteger('purchase_order_id')->nullable(); // Lien avec commande d'achat
            $table->unsignedBigInteger('created_by');
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('erp_sales_customers')->onDelete('set null');
            $table->foreign('supplier_id')->references('id')->on('erp_purchases_suppliers')->onDelete('set null');
            $table->foreign('invoice_id')->references('id')->on('erp_sales_invoices')->onDelete('set null');
            $table->foreign('purchase_order_id')->references('id')->on('erp_purchases_purchase_orders')->onDelete('set null');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('erp_accounting_payments');
    }
}; 