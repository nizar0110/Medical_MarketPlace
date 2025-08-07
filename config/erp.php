<?php

return [
    /*
    |--------------------------------------------------------------------------
    | ERP Modules Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration pour les modules ERP du marketplace médical
    |
    */

    'modules' => [
        'inventory' => [
            'enabled' => env('ERP_INVENTORY_ENABLED', true),
            'name' => 'Gestion des stocks',
            'description' => 'Module de gestion des stocks multi-entrepôts',
            'permissions' => [
                'view_inventory',
                'manage_warehouses',
                'manage_locations',
                'create_stock_movements',
                'view_stock_reports',
                'manage_stock_levels',
            ],
        ],
        'sales' => [
            'enabled' => env('ERP_SALES_ENABLED', true),
            'name' => 'Ventes',
            'description' => 'Module de gestion des ventes et facturation',
            'permissions' => [
                'view_sales',
                'manage_customers',
                'create_quotes',
                'create_invoices',
                'view_sales_reports',
                'manage_payment_terms',
            ],
        ],
        'purchases' => [
            'enabled' => env('ERP_PURCHASES_ENABLED', true),
            'name' => 'Achats',
            'description' => 'Module de gestion des achats et fournisseurs',
            'permissions' => [
                'view_purchases',
                'manage_suppliers',
                'create_purchase_orders',
                'receive_goods',
                'view_purchase_reports',
                'manage_supplier_terms',
            ],
        ],
        'accounting' => [
            'enabled' => env('ERP_ACCOUNTING_ENABLED', true),
            'name' => 'Comptabilité',
            'description' => 'Module de comptabilité et gestion financière',
            'permissions' => [
                'view_accounting',
                'manage_chart_of_accounts',
                'create_journal_entries',
                'view_financial_reports',
                'manage_payments',
                'view_audit_trail',
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | ERP Roles Configuration
    |--------------------------------------------------------------------------
    |
    | Rôles utilisateur pour les modules ERP
    |
    */

    'roles' => [
        'warehouse_manager' => [
            'name' => 'Gestionnaire d\'entrepôt',
            'permissions' => [
                'view_inventory',
                'manage_warehouses',
                'manage_locations',
                'create_stock_movements',
                'view_stock_reports',
                'manage_stock_levels',
            ],
        ],
        'accountant' => [
            'name' => 'Comptable',
            'permissions' => [
                'view_accounting',
                'manage_chart_of_accounts',
                'create_journal_entries',
                'view_financial_reports',
                'manage_payments',
                'view_audit_trail',
            ],
        ],
        'buyer' => [
            'name' => 'Acheteur',
            'permissions' => [
                'view_purchases',
                'manage_suppliers',
                'create_purchase_orders',
                'receive_goods',
                'view_purchase_reports',
                'manage_supplier_terms',
            ],
        ],
        'sales_manager' => [
            'name' => 'Responsable commercial',
            'permissions' => [
                'view_sales',
                'manage_customers',
                'create_quotes',
                'create_invoices',
                'view_sales_reports',
                'manage_payment_terms',
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | ERP Settings
    |--------------------------------------------------------------------------
    |
    | Paramètres généraux du système ERP
    |
    */

    'settings' => [
        'company_name' => env('ERP_COMPANY_NAME', 'Medical Marketplace'),
        'company_address' => env('ERP_COMPANY_ADDRESS', ''),
        'company_phone' => env('ERP_COMPANY_PHONE', ''),
        'company_email' => env('ERP_COMPANY_EMAIL', ''),
        'tax_rate' => env('ERP_DEFAULT_TAX_RATE', 20.0), // Taux de TVA par défaut
        'currency' => env('ERP_CURRENCY', 'EUR'),
        'fiscal_year_start' => env('ERP_FISCAL_YEAR_START', '01-01'),
        'auto_generate_journal_entries' => env('ERP_AUTO_JOURNAL_ENTRIES', true),
        'stock_valuation_method' => env('ERP_STOCK_VALUATION', 'average'), // average, fifo, lifo
        'default_payment_terms' => env('ERP_DEFAULT_PAYMENT_TERMS', 30), // jours
    ],

    /*
    |--------------------------------------------------------------------------
    | ERP Workflows
    |--------------------------------------------------------------------------
    |
    | Configuration des workflows automatiques
    |
    */

    'workflows' => [
        'sales_order_to_invoice' => [
            'enabled' => true,
            'auto_generate_invoice' => true,
            'auto_update_stock' => true,
            'auto_create_journal_entry' => true,
        ],
        'purchase_order_to_receipt' => [
            'enabled' => true,
            'auto_update_stock' => true,
            'auto_create_journal_entry' => true,
        ],
        'payment_processing' => [
            'enabled' => true,
            'auto_update_invoice_status' => true,
            'auto_create_journal_entry' => true,
        ],
    ],
]; 