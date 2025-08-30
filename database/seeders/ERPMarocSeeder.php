<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ERPMarocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('🇲🇦 Configuration ERP Maroc en cours...');

        // Créer des fournisseurs marocains
        $this->createMoroccanSuppliers();
        
        // Créer des clients marocains
        $this->createMoroccanCustomers();
        
        // Créer des devis et factures d'exemple
        $this->createSampleQuotesAndInvoices();

        $this->command->info('✅ Configuration ERP Maroc terminée !');
    }

    private function createMoroccanSuppliers()
    {
        $suppliers = [
            [
                'supplier_code' => 'SUP-001',
                'company_name' => 'PharmaTech Maroc',
                'contact_name' => 'Ahmed Benali',
                'email' => 'contact@pharmatech.ma',
                'phone' => '+212 5 22 34 56 78',
                'address' => '45 Boulevard Mohammed V',
                'city' => 'Casablanca',
                'state' => 'Casablanca-Settat',
                'country' => 'Maroc',
                'postal_code' => '20000',
                'payment_terms_days' => 30,
                'status' => 'active',
                'supplier_type' => 'manufacturer',
            ],
            [
                'supplier_code' => 'SUP-002',
                'company_name' => 'MediSupply Rabat',
                'contact_name' => 'Fatima Zahra',
                'email' => 'info@medisupply.ma',
                'phone' => '+212 5 37 23 45 67',
                'address' => '78 Avenue Hassan II',
                'city' => 'Rabat',
                'state' => 'Rabat-Salé-Kénitra',
                'country' => 'Maroc',
                'postal_code' => '10000',
                'payment_terms_days' => 45,
                'status' => 'active',
                'supplier_type' => 'distributor',
            ],
            [
                'supplier_code' => 'SUP-003',
                'company_name' => 'EquipMedical Fès',
                'contact_name' => 'Mohammed Tazi',
                'email' => 'ventes@equipmedical.ma',
                'phone' => '+212 5 35 67 89 01',
                'address' => '123 Rue des Médecins',
                'city' => 'Fès',
                'state' => 'Fès-Meknès',
                'country' => 'Maroc',
                'postal_code' => '30000',
                'payment_terms_days' => 30,
                'status' => 'active',
                'supplier_type' => 'wholesaler',
            ]
        ];

        foreach ($suppliers as $supplier) {
            DB::table('erp_purchases_suppliers')->insert(array_merge($supplier, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        $this->command->info('✅ Fournisseurs marocains créés');
    }

    private function createMoroccanCustomers()
    {
        $customers = [
            [
                'customer_code' => 'CUST-001',
                'company_name' => 'Clinique Al Shifa',
                'contact_name' => 'Dr. Karim Bennani',
                'email' => 'contact@alshifa.ma',
                'phone' => '+212 5 22 45 67 89',
                'address' => '15 Rue de la Paix',
                'city' => 'Casablanca',
                'state' => 'Casablanca-Settat',
                'country' => 'Maroc',
                'postal_code' => '20000',
                'payment_terms_days' => 30,
                'credit_limit' => 50000.00,
                'status' => 'active',
                'customer_type' => 'healthcare',
            ],
            [
                'customer_code' => 'CUST-002',
                'company_name' => 'Hôpital Provincial de Tanger',
                'contact_name' => 'Dr. Amina El Fassi',
                'email' => 'achats@hptanger.ma',
                'phone' => '+212 5 39 34 56 78',
                'address' => 'Avenue Ibn Batouta',
                'city' => 'Tanger',
                'state' => 'Tanger-Tétouan-Al Hoceïma',
                'country' => 'Maroc',
                'postal_code' => '90000',
                'payment_terms_days' => 60,
                'credit_limit' => 100000.00,
                'status' => 'active',
                'customer_type' => 'healthcare',
            ],
            [
                'customer_code' => 'CUST-003',
                'company_name' => 'Centre Médical Atlas',
                'contact_name' => 'Mme. Leila Mansouri',
                'email' => 'info@atlasmedical.ma',
                'phone' => '+212 5 24 56 78 90',
                'address' => '67 Boulevard Zerktouni',
                'city' => 'Marrakech',
                'state' => 'Marrakech-Safi',
                'country' => 'Maroc',
                'postal_code' => '40000',
                'payment_terms_days' => 30,
                'credit_limit' => 75000.00,
                'status' => 'active',
                'customer_type' => 'healthcare',
            ]
        ];

        foreach ($customers as $customer) {
            DB::table('erp_sales_customers')->insert(array_merge($customer, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        $this->command->info('✅ Clients marocains créés');
    }

    private function createSampleQuotesAndInvoices()
    {
        // Créer un devis d'exemple
        $quoteId = DB::table('erp_sales_quotes')->insertGetId([
            'customer_id' => 1,
            'quote_number' => 'DEV-2025-001',
            'quote_date' => now(),
            'valid_until' => now()->addDays(30),
            'status' => 'pending',
            'subtotal' => 15000.00,
            'tax_amount' => 3000.00, // TVA 20% marocaine
            'total_amount' => 18000.00,
            'notes' => 'Devis pour équipements de diagnostic',
            'created_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Créer des éléments du devis
        DB::table('erp_sales_quote_items')->insert([
            'quote_id' => $quoteId,
            'product_name' => 'Électrocardiographe portable',
            'description' => 'ECG 12 dérivations avec analyse automatique',
            'quantity' => 2,
            'unit_price' => 7500.00,
            'tax_rate' => 20.0, // TVA marocaine
            'tax_amount' => 3000.00,
            'subtotal' => 15000.00,
            'total_amount' => 18000.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Créer une facture d'exemple
        $invoiceId = DB::table('erp_sales_invoices')->insertGetId([
            'customer_id' => 1,
            'invoice_number' => 'FACT-2025-001',
            'invoice_date' => now(),
            'due_date' => now()->addDays(30),
            'status' => 'pending',
            'subtotal' => 15000.00,
            'tax_amount' => 3000.00, // TVA 20% marocaine
            'total_amount' => 18000.00,
            'notes' => 'Facture pour équipements de diagnostic',
            'created_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->command->info('✅ Devis et factures d\'exemple créés');
    }
}
