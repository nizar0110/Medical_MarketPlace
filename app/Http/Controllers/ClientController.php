<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Product;

class ClientController extends Controller
{
    /**
     * Afficher le dashboard client
     */
    public function dashboard()
    {
        $user = Auth::user();
        
        // Récupérer les commandes récentes
        $recentOrders = Order::where('client_id', $user->id)
            ->latest()
            ->take(5)
            ->get();
        
        // Récupérer les produits favoris
        $favorites = $user->favorites()->with('category')->latest()->take(5)->get();
        $favoritesCount = $user->favorites()->count();
        
        // Calculer le total dépensé
        $totalSpent = Order::where('client_id', $user->id)
            ->where('status', 'completed')
            ->sum('total');
        
        // Compter les commandes
        $ordersCount = Order::where('client_id', $user->id)->count();
        
        // Compter les commandes livrées
        $deliveredCount = Order::where('client_id', $user->id)
            ->where('status', 'shipped')
            ->count();
        
        return view('client.dashboard', compact(
            'recentOrders',
            'favorites',
            'favoritesCount',
            'totalSpent',
            'ordersCount',
            'deliveredCount'
        ));
    }

    /**
     * Afficher tous les favoris
     */
    public function favorites()
    {
        $user = Auth::user();
        $favorites = $user->favorites()->with('category')->paginate(12);
        
        return view('client.favorites', compact('favorites'));
    }

    /**
     * Afficher toutes les commandes
     */
    public function orders()
    {
        $user = Auth::user();
        $orders = Order::where('client_id', $user->id)
            ->latest()
            ->paginate(10);
        
        return view('client.orders', compact('orders'));
    }

    /**
     * Afficher le profil client
     */
    public function profile()
    {
        $user = Auth::user();
        
        return view('client.profile', compact('user'));
    }
}
