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
            'total_amount' => '0.00 €'
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
            ->orderBy('name')
            ->paginate(15);
            
        $stats = ['title' => 'Gestion des Fournisseurs'];
            
        return view('erp.purchases.suppliers', compact('suppliers', 'stats'));
    }
    
    /**
     * Liste des commandes
     */
    public function purchaseOrders()
    {
        $orders = DB::table('erp_purchases_purchase_orders')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        $stats = ['title' => 'Commandes d\'Achat'];
            
        return view('erp.purchases.purchase_orders', compact('orders', 'stats'));
    }
} 