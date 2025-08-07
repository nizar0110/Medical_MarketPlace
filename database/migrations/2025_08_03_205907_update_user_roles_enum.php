<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, we need to drop the enum constraint and recreate it
        DB::statement("ALTER TABLE users MODIFY COLUMN role VARCHAR(50) DEFAULT 'client'");
        
        // Then recreate the enum with all roles
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'seller', 'client', 'warehouse_manager', 'accountant', 'buyer', 'sales_manager') DEFAULT 'client'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert to original enum
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'seller', 'client') DEFAULT 'client'");
    }
}; 