<?php

namespace App\Http\Controllers\ERP;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountingController extends Controller
{
    /**
     * Afficher le tableau de bord comptabilité
     */
    public function dashboard()
    {
        $user = auth()->user();
        
        // Statistiques comptabilité
        $stats = [
            'title' => 'Comptabilité',
            'active_accounts' => DB::table('erp_accounting_chart_of_accounts')->where('is_active', true)->count(),
            'monthly_entries' => DB::table('erp_accounting_journal_entries')
                ->whereMonth('created_at', now()->month)
                ->count(),
            'pending_payments' => DB::table('erp_accounting_payments')
                ->where('status', 'pending')
                ->count(),
            'total_balance' => '0.00 €'
        ];
        
        // Comptes récents
        $recentAccounts = DB::table('erp_accounting_chart_of_accounts')
            ->where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
            
        // Écritures récentes
        $recentEntries = DB::table('erp_accounting_journal_entries')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
        
        return view('erp.accounting.dashboard', compact('stats', 'recentAccounts', 'recentEntries', 'user'));
    }
    
    /**
     * Plan comptable
     */
    public function chartOfAccounts()
    {
        $accounts = DB::table('erp_accounting_chart_of_accounts')
            ->where('is_active', true)
            ->orderBy('account_code')
            ->paginate(15);
            
        $stats = ['title' => 'Plan Comptable'];
            
        return view('erp.accounting.chart_of_accounts', compact('accounts', 'stats'));
    }
    
    /**
     * Journal des écritures
     */
    public function journalEntries()
    {
        $entries = DB::table('erp_accounting_journal_entries')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        $stats = ['title' => 'Journal des Écritures'];
            
        return view('erp.accounting.journal_entries', compact('entries', 'stats'));
    }
} 