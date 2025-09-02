<?php

namespace App\Http\Controllers\ERP;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchasesController extends Controller
{
    /**
     * Afficher le tableau de bord achats
     */
    public function dashboard()
    {
        $user = auth()->user();
        
        // Statistiques achats
        $stats = [
            'title' => 'Achats',
            'suppliers_count' => DB::table('erp_purchases_suppliers')->count(),
            'pending_orders' => DB::table('erp_purchases_purchase_orders')
                ->where('status', 'pending')
                ->count(),
            'monthly_orders' => DB::table('erp_purchases_purchase_orders')
                ->whereMonth('created_at', now()->month)
                ->count(),
            'total_amount' => '0.00 DH'
        ];
        
        // Fournisseurs récents
        $recentSuppliers = DB::table('erp_purchases_suppliers')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
            
        // Commandes récentes
        $recentOrders = DB::table('erp_purchases_purchase_orders')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
        
        return view('erp.purchases.dashboard', compact('stats', 'recentSuppliers', 'recentOrders', 'user'));
    }
    
    /**
     * Liste des fournisseurs
     */
    public function suppliers()
    {
        $suppliers = DB::table('erp_purchases_suppliers')
            ->orderBy('company_name')
            ->paginate(15);
            
        $stats = ['title' => 'Gestion des Fournisseurs'];
            
        return view('erp.purchases.suppliers', compact('suppliers', 'stats'));
    }
    
    /**
     * Créer un nouveau fournisseur
     */
    public function storeSupplier(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'contact_name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
        ]);

        // Générer un code fournisseur unique
        $supplierCode = 'SUP-' . str_pad(DB::table('erp_purchases_suppliers')->count() + 1, 3, '0', STR_PAD_LEFT);

        DB::table('erp_purchases_suppliers')->insert([
            'supplier_code' => $supplierCode,
            'company_name' => $request->company_name,
            'contact_name' => $request->contact_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'postal_code' => $request->postal_code,
            'status' => 'active',
            'supplier_type' => 'distributor',
            'payment_terms_days' => 30,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('erp.purchases.suppliers')
            ->with('success', 'Fournisseur créé avec succès !');
    }
    
    /**
     * Créer une nouvelle commande d'achat
     */
    public function storePurchaseOrder(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|exists:erp_purchases_suppliers,id',
            'reference' => 'nullable|string|max:100',
            'notes' => 'nullable|string|max:500',
            'items' => 'required|array|min:1',
            'items.*.product_name' => 'required|string|max:255',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        // Générer une référence unique si non fournie
        if (empty($request->reference)) {
            // Trouver le dernier numéro de commande pour éviter les doublons
            $lastOrder = DB::table('erp_purchases_purchase_orders')
                ->orderBy('po_number', 'desc')
                ->first();
            
            if ($lastOrder) {
                // Essayer d'extraire un numéro du dernier PO
                $lastPoNumber = $lastOrder->po_number;
                
                // Vérifier si c'est un format PO-XXX
                if (preg_match('/^PO-(\d+)$/', $lastPoNumber, $matches)) {
                    $lastNumber = (int) $matches[1];
                    $newNumber = $lastNumber + 1;
                } else {
                    // Si ce n'est pas un format PO-XXX, commencer à 1
                    $newNumber = 1;
                }
            } else {
                $newNumber = 1;
            }
            
            $poNumber = 'PO-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        } else {
            // Vérifier si la référence fournie existe déjà
            $existingOrder = DB::table('erp_purchases_purchase_orders')
                ->where('po_number', $request->reference)
                ->first();
            
            if ($existingOrder) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['reference' => 'Cette référence de commande existe déjà. Veuillez en choisir une autre.']);
            }
            
            $poNumber = $request->reference;
        }

        // Calculer le montant total
        $totalAmount = 0;
        foreach ($request->items as $item) {
            $totalAmount += $item['quantity'] * $item['unit_price'];
        }

        // Créer la commande
        $orderId = DB::table('erp_purchases_purchase_orders')->insertGetId([
            'po_number' => $poNumber,
            'supplier_id' => $request->supplier_id,
            'warehouse_id' => 1, // Défaut
            'order_date' => now(),
            'expected_delivery_date' => now()->addDays(7),
            'subtotal' => $totalAmount,
            'tax_amount' => 0,
            'shipping_amount' => 0,
            'total_amount' => $totalAmount,
            'status' => 'draft',
            'payment_status' => 'unpaid',
            'notes' => $request->notes,
            'terms_conditions' => '',
            'created_by' => auth()->id(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Créer les lignes de commande
        foreach ($request->items as $item) {
            DB::table('erp_purchases_purchase_order_items')->insert([
                'purchase_order_id' => $orderId,
                'product_id' => 1, // ID par défaut pour l'instant
                'quantity_ordered' => $item['quantity'],
                'quantity_received' => 0,
                'unit_cost' => $item['unit_price'],
                'tax_rate' => 0.00,
                'tax_amount' => 0.00,
                'total_amount' => $item['quantity'] * $item['unit_price'],
                'description' => $item['product_name'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->route('erp.purchases.purchase_orders')
            ->with('success', 'Commande d\'achat créée avec succès !');
    }
    
    /**
     * Liste des commandes
     */
    public function purchaseOrders()
    {
        $orders = DB::table('erp_purchases_purchase_orders')
            ->join('erp_purchases_suppliers', 'erp_purchases_purchase_orders.supplier_id', '=', 'erp_purchases_suppliers.id')
            ->select('erp_purchases_purchase_orders.*', 'erp_purchases_suppliers.company_name as supplier_name')
            ->orderBy('erp_purchases_purchase_orders.created_at', 'desc')
            ->paginate(15);
            
        // Récupérer tous les fournisseurs pour le select
        $suppliers = DB::table('erp_purchases_suppliers')
            ->where('status', 'active')
            ->orderBy('company_name')
            ->get(['id', 'company_name', 'contact_name']);
            
        $stats = ['title' => 'Commandes d\'Achat'];
            
        return view('erp.purchases.purchase_orders', compact('orders', 'suppliers', 'stats'));
    }
} 