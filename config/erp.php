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
        'company_name' => env('ERP_COMPANY_NAME', 'Medical Market SARL'),
        'company_address' => env('ERP_COMPANY_ADDRESS', '123 Rue de la Santé, Quartier Maarif, Casablanca 20000, Maroc'),
        'company_phone' => env('ERP_COMPANY_PHONE', '+212 6 12 345 678'),
        'company_email' => env('ERP_COMPANY_EMAIL', 'erp@medicalmarket.ma'),
        'tax_rate' => env('ERP_DEFAULT_TAX_RATE', 20.0), // Taux de TVA marocain par défaut
        'currency' => env('ERP_CURRENCY', 'MAD'), // Dirham marocain
        'fiscal_year_start' => env('ERP_FISCAL_YEAR_START', '01-01'), // Année fiscale marocaine
        'auto_generate_journal_entries' => env('ERP_AUTO_JOURNAL_ENTRIES', true),
        'stock_valuation_method' => env('ERP_STOCK_VALUATION', 'average'), // average, fifo, lifo
        'default_payment_terms' => env('ERP_DEFAULT_PAYMENT_TERMS', 30), // jours (standard marocain)
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