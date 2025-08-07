<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ERPInventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer un entrepôt principal
        $warehouseId = DB::table('erp_inventory_warehouses')->insertGetId([
            'name' => 'Entrepôt Principal',
            'code' => 'WH-001',
            'description' => 'Entrepôt principal du marketplace médical',
            'address' => '123 Rue de la Santé',
            'city' => 'Paris',
            'state' => 'Île-de-France',
            'country' => 'France',
            'postal_code' => '75001',
            'phone' => '+33 1 23 45 67 89',
            'email' => 'warehouse@medicalmarketplace.com',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Créer des emplacements dans l'entrepôt
        $locations = [
            ['name' => 'Zone A - Allée 1', 'code' => 'A1', 'aisle' => 'A', 'rack' => '1'],
            ['name' => 'Zone A - Allée 2', 'code' => 'A2', 'aisle' => 'A', 'rack' => '2'],
            ['name' => 'Zone B - Allée 1', 'code' => 'B1', 'aisle' => 'B', 'rack' => '1'],
            ['name' => 'Zone B - Allée 2', 'code' => 'B2', 'aisle' => 'B', 'rack' => '2'],
            ['name' => 'Zone C - Réfrigéré', 'code' => 'C1', 'aisle' => 'C', 'rack' => '1'],
            ['name' => 'Zone D - Matériel lourd', 'code' => 'D1', 'aisle' => 'D', 'rack' => '1'],
        ];

        foreach ($locations as $location) {
            DB::table('erp_inventory_locations')->insert([
                'warehouse_id' => $warehouseId,
                'name' => $location['name'],
                'code' => $location['code'],
                'aisle' => $location['aisle'],
                'rack' => $location['rack'],
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Créer un entrepôt secondaire
        $warehouse2Id = DB::table('erp_inventory_warehouses')->insertGetId([
            'name' => 'Entrepôt Régional',
            'code' => 'WH-002',
            'description' => 'Entrepôt régional pour la distribution',
            'address' => '456 Avenue des Soins',
            'city' => 'Lyon',
            'state' => 'Auvergne-Rhône-Alpes',
            'country' => 'France',
            'postal_code' => '69001',
            'phone' => '+33 4 78 12 34 56',
            'email' => 'warehouse.lyon@medicalmarketplace.com',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Créer des emplacements dans l'entrepôt secondaire
        $locations2 = [
            ['name' => 'Zone A - Général', 'code' => 'LY-A1', 'aisle' => 'A', 'rack' => '1'],
            ['name' => 'Zone B - Spécialisé', 'code' => 'LY-B1', 'aisle' => 'B', 'rack' => '1'],
        ];

        foreach ($locations2 as $location) {
            DB::table('erp_inventory_locations')->insert([
                'warehouse_id' => $warehouse2Id,
                'name' => $location['name'],
                'code' => $location['code'],
                'aisle' => $location['aisle'],
                'rack' => $location['rack'],
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
} 