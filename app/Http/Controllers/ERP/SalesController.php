<?php

namespace App\Http\Controllers\ERP;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    /**
     * Afficher le tableau de bord ventes
     */
    public function dashboard()
    {
        $user = auth()->user();
        
        // Statistiques ventes
        $stats = [
            'title' => 'Ventes',
            'customers_count' => DB::table('erp_sales_customers')->count(),
            'pending_quotes' => DB::table('erp_sales_quotes')
                ->where('status', 'pending')
                ->count(),
            'monthly_invoices' => DB::table('erp_sales_invoices')
                ->whereMonth('created_at', now()->month)
                ->count(),
            'total_revenue' => '0.00 €'
        ];
        
        // Clients récents
        $recentCustomers = DB::table('erp_sales_customers')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
            
        // Devis récents
        $recentQuotes = DB::table('erp_sales_quotes')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
        
        return view('erp.sales.dashboard', compact('stats', 'recentCustomers', 'recentQuotes', 'user'));
    }
    
    /**
     * Liste des clients
     */
    public function customers()
    {
        $customers = DB::table('erp_sales_customers')
            ->orderBy('name')
            ->paginate(15);
            
        $stats = ['title' => 'Gestion des Clients'];
            
        return view('erp.sales.customers', compact('customers', 'stats'));
    }
    
    /**
     * Liste des devis
     */
    public function quotes()
    {
        $quotes = DB::table('erp_sales_quotes')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        $stats = ['title' => 'Gestion des Devis'];
            
        return view('erp.sales.quotes', compact('quotes', 'stats'));
    }
    
    /**
     * Liste des factures
     */
    public function invoices()
    {
        $invoices = DB::table('erp_sales_invoices')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        $stats = ['title' => 'Gestion des Factures'];
            
        return view('erp.sales.invoices', compact('invoices', 'stats'));
    }
} 