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
            ->orderBy('contact_name')
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
            ->join('erp_sales_customers', 'erp_sales_quotes.customer_id', '=', 'erp_sales_customers.id')
            ->select('erp_sales_quotes.*', 'erp_sales_customers.contact_name as customer_name')
            ->orderBy('erp_sales_quotes.created_at', 'desc')
            ->paginate(15);
            
        // Récupérer tous les clients pour le select
        $customers = DB::table('erp_sales_customers')
            ->where('status', 'active')
            ->orderBy('contact_name')
            ->get(['id', 'contact_name', 'company_name']);
            
        // Récupérer tous les produits pour le select
        $products = DB::table('products')
            ->orderBy('name')
            ->get(['id', 'name', 'price']);
            
        $stats = ['title' => 'Gestion des Devis'];
            
        return view('erp.sales.quotes', compact('quotes', 'customers', 'products', 'stats'));
    }
    
    /**
     * Créer un nouveau devis
     */
    public function storeQuote(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:erp_sales_customers,id',
            'reference' => 'nullable|string|max:100',
            'valid_until' => 'nullable|date',
            'notes' => 'nullable|string|max:500',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        // Générer une référence unique si non fournie
        if (empty($request->reference)) {
            do {
                $count = DB::table('erp_sales_quotes')->count() + 1;
                $quoteNumber = 'DEV-' . str_pad($count, 3, '0', STR_PAD_LEFT);
                $exists = DB::table('erp_sales_quotes')->where('quote_number', $quoteNumber)->exists();
            } while ($exists);
        } else {
            $quoteNumber = $request->reference;
            // Vérifier si la référence fournie existe déjà
            if (DB::table('erp_sales_quotes')->where('quote_number', $quoteNumber)->exists()) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'La référence "' . $quoteNumber . '" existe déjà. Veuillez en choisir une autre.');
            }
        }

        // Calculer le montant total
        $totalAmount = 0;
        foreach ($request->items as $item) {
            $totalAmount += $item['quantity'] * $item['unit_price'];
        }

        // Créer le devis
        $quoteId = DB::table('erp_sales_quotes')->insertGetId([
            'quote_number' => $quoteNumber,
            'customer_id' => $request->customer_id,
            'quote_date' => now()->toDateString(),
            'valid_until' => $request->valid_until ?: now()->addDays(30)->toDateString(),
            'subtotal' => $totalAmount,
            'tax_amount' => 0,
            'discount_amount' => 0,
            'total_amount' => $totalAmount,
            'status' => 'draft',
            'notes' => $request->notes,
            'terms_conditions' => '',
            'created_by' => auth()->id(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Créer les lignes du devis
        foreach ($request->items as $item) {
            DB::table('erp_sales_quote_items')->insert([
                'quote_id' => $quoteId,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
                'total_amount' => $item['quantity'] * $item['unit_price'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->route('erp.sales.quotes')
            ->with('success', 'Devis créé avec succès !');
    }
    
    /**
     * Liste des factures
     */
    public function invoices()
    {
        $invoices = DB::table('erp_sales_invoices')
            ->join('erp_sales_customers', 'erp_sales_invoices.customer_id', '=', 'erp_sales_customers.id')
            ->select('erp_sales_invoices.*', 'erp_sales_customers.contact_name as customer_name')
            ->orderBy('erp_sales_invoices.created_at', 'desc')
            ->paginate(15);
            
        // Récupérer tous les clients pour le select
        $customers = DB::table('erp_sales_customers')
            ->where('status', 'active')
            ->orderBy('contact_name')
            ->get(['id', 'contact_name', 'company_name']);
            
        // Récupérer tous les produits pour le select
        $products = DB::table('products')
            ->orderBy('name')
            ->get(['id', 'name', 'price']);
            
        $stats = ['title' => 'Gestion des Factures'];
            
        return view('erp.sales.invoices', compact('invoices', 'customers', 'products', 'stats'));
    }
    
    /**
     * Créer une nouvelle facture
     */
    public function storeInvoice(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:erp_sales_customers,id',
            'invoice_number' => 'nullable|string|max:100',
            'due_date' => 'nullable|date',
            'notes' => 'nullable|string|max:500',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        // Générer un numéro de facture unique si non fourni
        if (empty($request->invoice_number)) {
            do {
                $count = DB::table('erp_sales_invoices')->count() + 1;
                $invoiceNumber = 'FAC-' . str_pad($count, 3, '0', STR_PAD_LEFT);
                $exists = DB::table('erp_sales_invoices')->where('invoice_number', $invoiceNumber)->exists();
            } while ($exists);
        } else {
            $invoiceNumber = $request->invoice_number;
            // Vérifier si le numéro fourni existe déjà
            if (DB::table('erp_sales_invoices')->where('invoice_number', $invoiceNumber)->exists()) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Le numéro de facture "' . $invoiceNumber . '" existe déjà. Veuillez en choisir un autre.');
            }
        }

        // Calculer le montant total
        $totalAmount = 0;
        foreach ($request->items as $item) {
            $totalAmount += $item['quantity'] * $item['unit_price'];
        }

        // Créer la facture
        $invoiceId = DB::table('erp_sales_invoices')->insertGetId([
            'invoice_number' => $invoiceNumber,
            'customer_id' => $request->customer_id,
            'order_id' => null,
            'invoice_date' => now()->toDateString(),
            'due_date' => $request->due_date ?: now()->addDays(30)->toDateString(),
            'subtotal' => $totalAmount,
            'tax_amount' => 0,
            'discount_amount' => 0,
            'shipping_amount' => 0,
            'total_amount' => $totalAmount,
            'amount_paid' => 0,
            'balance_due' => $totalAmount,
            'status' => 'draft',
            'payment_status' => 'unpaid',
            'notes' => $request->notes,
            'terms_conditions' => '',
            'created_by' => auth()->id(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Créer les lignes de la facture
        foreach ($request->items as $item) {
            DB::table('erp_sales_invoice_items')->insert([
                'invoice_id' => $invoiceId,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
                'total_amount' => $item['quantity'] * $item['unit_price'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->route('erp.sales.invoices')
            ->with('success', 'Facture créée avec succès !');
    }
} 