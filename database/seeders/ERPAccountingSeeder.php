<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ERPAccountingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Plan comptable de base pour un marketplace médical
        $accounts = [
            // Actifs courants
            ['account_code' => '1000', 'account_name' => 'Caisse', 'account_type' => 'asset', 'account_category' => 'current_assets'],
            ['account_code' => '1010', 'account_name' => 'Banque', 'account_type' => 'asset', 'account_category' => 'current_assets'],
            ['account_code' => '1100', 'account_name' => 'Comptes clients', 'account_type' => 'asset', 'account_category' => 'current_assets'],
            ['account_code' => '1200', 'account_name' => 'Stocks de marchandises', 'account_type' => 'asset', 'account_category' => 'current_assets'],
            ['account_code' => '1300', 'account_name' => 'TVA à récupérer', 'account_type' => 'asset', 'account_category' => 'current_assets'],
            
            // Actifs immobilisés
            ['account_code' => '2000', 'account_name' => 'Matériel informatique', 'account_type' => 'asset', 'account_category' => 'fixed_assets'],
            ['account_code' => '2100', 'account_name' => 'Mobilier et installations', 'account_type' => 'asset', 'account_category' => 'fixed_assets'],
            ['account_code' => '2200', 'account_name' => 'Amortissements', 'account_type' => 'asset', 'account_category' => 'fixed_assets'],
            
            // Passifs courants
            ['account_code' => '3000', 'account_name' => 'Comptes fournisseurs', 'account_type' => 'liability', 'account_category' => 'current_liabilities'],
            ['account_code' => '3100', 'account_name' => 'TVA à payer', 'account_type' => 'liability', 'account_category' => 'current_liabilities'],
            ['account_code' => '3200', 'account_name' => 'Salaires à payer', 'account_type' => 'liability', 'account_category' => 'current_liabilities'],
            ['account_code' => '3300', 'account_name' => 'Charges sociales à payer', 'account_type' => 'liability', 'account_category' => 'current_liabilities'],
            
            // Capitaux propres
            ['account_code' => '4000', 'account_name' => 'Capital social', 'account_type' => 'equity', 'account_category' => 'equity'],
            ['account_code' => '4100', 'account_name' => 'Réserves', 'account_type' => 'equity', 'account_category' => 'equity'],
            ['account_code' => '4200', 'account_name' => 'Résultat de l\'exercice', 'account_type' => 'equity', 'account_category' => 'equity'],
            
            // Produits
            ['account_code' => '5000', 'account_name' => 'Ventes de marchandises', 'account_type' => 'revenue', 'account_category' => 'revenue'],
            ['account_code' => '5100', 'account_name' => 'Commissions', 'account_type' => 'revenue', 'account_category' => 'revenue'],
            ['account_code' => '5200', 'account_name' => 'Produits financiers', 'account_type' => 'revenue', 'account_category' => 'revenue'],
            
            // Charges
            ['account_code' => '6000', 'account_name' => 'Achats de marchandises', 'account_type' => 'expense', 'account_category' => 'cost_of_goods_sold'],
            ['account_code' => '6100', 'account_name' => 'Variation des stocks', 'account_type' => 'expense', 'account_category' => 'cost_of_goods_sold'],
            ['account_code' => '6200', 'account_name' => 'Salaires et charges sociales', 'account_type' => 'expense', 'account_category' => 'operating_expenses'],
            ['account_code' => '6300', 'account_name' => 'Loyers', 'account_type' => 'expense', 'account_category' => 'operating_expenses'],
            ['account_code' => '6400', 'account_name' => 'Électricité, eau, gaz', 'account_type' => 'expense', 'account_category' => 'operating_expenses'],
            ['account_code' => '6500', 'account_name' => 'Télécommunications', 'account_type' => 'expense', 'account_category' => 'operating_expenses'],
            ['account_code' => '6600', 'account_name' => 'Assurances', 'account_type' => 'expense', 'account_category' => 'operating_expenses'],
            ['account_code' => '6700', 'account_name' => 'Services bancaires', 'account_type' => 'expense', 'account_category' => 'operating_expenses'],
            ['account_code' => '6800', 'account_name' => 'Publicité et marketing', 'account_type' => 'expense', 'account_category' => 'operating_expenses'],
            ['account_code' => '6900', 'account_name' => 'Divers', 'account_type' => 'expense', 'account_category' => 'other_expenses'],
        ];

        foreach ($accounts as $account) {
            DB::table('erp_accounting_chart_of_accounts')->insert([
                'account_code' => $account['account_code'],
                'account_name' => $account['account_name'],
                'account_type' => $account['account_type'],
                'account_category' => $account['account_category'],
                'opening_balance' => 0,
                'current_balance' => 0,
                'is_active' => true,
                'is_system_account' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
} 