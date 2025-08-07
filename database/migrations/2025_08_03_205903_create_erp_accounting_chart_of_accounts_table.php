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
        Schema::create('erp_accounting_chart_of_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('account_code')->unique();
            $table->string('account_name');
            $table->text('description')->nullable();
            $table->enum('account_type', ['asset', 'liability', 'equity', 'revenue', 'expense']);
            $table->enum('account_category', [
                'current_assets', 'fixed_assets', 'current_liabilities', 'long_term_liabilities',
                'equity', 'revenue', 'cost_of_goods_sold', 'operating_expenses', 'other_expenses'
            ]);
            $table->decimal('opening_balance', 15, 2)->default(0);
            $table->decimal('current_balance', 15, 2)->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_system_account')->default(false);
            $table->unsignedBigInteger('parent_account_id')->nullable();
            $table->timestamps();

            $table->foreign('parent_account_id')->references('id')->on('erp_accounting_chart_of_accounts')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('erp_accounting_chart_of_accounts');
    }
}; 