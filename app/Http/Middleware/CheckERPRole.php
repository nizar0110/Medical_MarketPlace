<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckERPRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $module = null): Response
    {
        $user = auth()->user();
        
        if (!$user) {
            return redirect()->route('login');
        }
        
        // Rôles ERP autorisés
        $erpRoles = ['warehouse_manager', 'accountant', 'buyer', 'sales_manager', 'admin'];
        
        if (!in_array($user->role, $erpRoles)) {
            return redirect()->route('dashboard')->with('error', 'Accès non autorisé à l\'ERP.');
        }
        
        // Vérification spécifique par module si demandé
        if ($module) {
            $moduleAccess = $this->getModuleAccess($user->role);
            
            if (!in_array($module, $moduleAccess)) {
                return redirect()->route('erp.dashboard')->with('error', 'Accès non autorisé à ce module.');
            }
        }
        
        return $next($request);
    }
    
    /**
     * Obtenir les modules accessibles selon le rôle
     */
    private function getModuleAccess(string $role): array
    {
        switch ($role) {
            case 'warehouse_manager':
                return ['inventory'];
                
            case 'accountant':
                return ['accounting'];
                
            case 'buyer':
                return ['purchases'];
                
            case 'sales_manager':
                return ['sales'];
                
            case 'admin':
                return ['inventory', 'accounting', 'purchases', 'sales'];
                
            default:
                return [];
        }
    }
} 