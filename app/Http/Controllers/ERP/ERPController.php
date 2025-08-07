<?php

namespace App\Http\Controllers\ERP;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ERPController extends Controller
{
    /**
     * Afficher le tableau de bord principal de l'ERP
     */
    public function dashboard()
    {
        $user = auth()->user();
        
        // Statistiques générales selon le rôle
        $stats = $this->getStatsByRole($user->role);
        
        return view('erp.dashboard', compact('stats', 'user'));
    }
    
    /**
     * Obtenir les statistiques selon le rôle de l'utilisateur
     */
    private function getStatsByRole($role)
    {
        switch ($role) {
            case 'warehouse_manager':
                return [
                    'title' => 'Gestion des Stocks',
                    'icon' => 'fas fa-warehouse',
                    'stats' => [
                        ['label' => 'Entrepôts', 'value' => 2, 'color' => 'primary'],
                        ['label' => 'Produits en Stock', 'value' => 0, 'color' => 'success'],
                        ['label' => 'Mouvements Aujourd\'hui', 'value' => 0, 'color' => 'info'],
                        ['label' => 'Alertes Stock', 'value' => 0, 'color' => 'warning'],
                    ]
                ];
                
            case 'accountant':
                return [
                    'title' => 'Comptabilité',
                    'icon' => 'fas fa-calculator',
                    'stats' => [
                        ['label' => 'Comptes Actifs', 'value' => 0, 'color' => 'primary'],
                        ['label' => 'Écritures du Mois', 'value' => 0, 'color' => 'success'],
                        ['label' => 'Paiements en Attente', 'value' => 0, 'color' => 'warning'],
                        ['label' => 'Solde Général', 'value' => '0 €', 'color' => 'info'],
                    ]
                ];
                
            case 'buyer':
                return [
                    'title' => 'Achats',
                    'icon' => 'fas fa-shopping-cart',
                    'stats' => [
                        ['label' => 'Fournisseurs', 'value' => 0, 'color' => 'primary'],
                        ['label' => 'Commandes en Cours', 'value' => 0, 'color' => 'warning'],
                        ['label' => 'Commandes du Mois', 'value' => 0, 'color' => 'success'],
                        ['label' => 'Montant Total', 'value' => '0 €', 'color' => 'info'],
                    ]
                ];
                
            case 'sales_manager':
                return [
                    'title' => 'Ventes',
                    'icon' => 'fas fa-chart-line',
                    'stats' => [
                        ['label' => 'Clients', 'value' => 0, 'color' => 'primary'],
                        ['label' => 'Devis en Cours', 'value' => 0, 'color' => 'warning'],
                        ['label' => 'Factures du Mois', 'value' => 0, 'color' => 'success'],
                        ['label' => 'Chiffre d\'Affaires', 'value' => '0 €', 'color' => 'info'],
                    ]
                ];
                
            default:
                return [
                    'title' => 'ERP - Vue Générale',
                    'icon' => 'fas fa-cogs',
                    'stats' => [
                        ['label' => 'Modules Actifs', 'value' => 4, 'color' => 'primary'],
                        ['label' => 'Utilisateurs ERP', 'value' => 0, 'color' => 'success'],
                        ['label' => 'Tâches en Cours', 'value' => 0, 'color' => 'warning'],
                        ['label' => 'Système', 'value' => 'Opérationnel', 'color' => 'info'],
                    ]
                ];
        }
    }
    
    /**
     * Afficher la page d'accueil de l'ERP
     */
    public function index()
    {
        return redirect()->route('erp.dashboard');
    }
} 