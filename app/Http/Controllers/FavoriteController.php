<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Ajouter un produit aux favoris
     */
    public function add(Request $request, $productId)
    {
        $user = Auth::user();
        $product = Product::findOrFail($productId);

        // Vérifier si le produit n'est pas déjà dans les favoris
        if (!$user->favorites()->where('product_id', $productId)->exists()) {
            $user->favorites()->attach($productId);
            return response()->json([
                'success' => true,
                'message' => 'Produit ajouté aux favoris',
                'isFavorite' => true
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Produit déjà dans les favoris',
            'isFavorite' => true
        ]);
    }

    /**
     * Retirer un produit des favoris
     */
    public function remove(Request $request, $productId)
    {
        $user = Auth::user();
        $product = Product::findOrFail($productId);

        $user->favorites()->detach($productId);

        return response()->json([
            'success' => true,
            'message' => 'Produit retiré des favoris',
            'isFavorite' => false
        ]);
    }

    /**
     * Basculer l'état des favoris (ajouter/retirer)
     */
    public function toggle(Request $request, $productId)
    {
        $user = Auth::user();
        $product = Product::findOrFail($productId);

        $isFavorite = $user->favorites()->where('product_id', $productId)->exists();

        if ($isFavorite) {
            $user->favorites()->detach($productId);
            $message = 'Produit retiré des favoris';
            $isFavorite = false;
        } else {
            $user->favorites()->attach($productId);
            $message = 'Produit ajouté aux favoris';
            $isFavorite = true;
        }

        return response()->json([
            'success' => true,
            'message' => $message,
            'isFavorite' => $isFavorite
        ]);
    }

    /**
     * Obtenir la liste des favoris d'un utilisateur
     */
    public function index()
    {
        $user = Auth::user();
        $favorites = $user->favorites()->with('category')->get();

        return response()->json([
            'success' => true,
            'favorites' => $favorites,
            'count' => $favorites->count()
        ]);
    }

    /**
     * Vérifier si un produit est dans les favoris
     */
    public function check($productId)
    {
        $user = Auth::user();
        $isFavorite = $user->favorites()->where('product_id', $productId)->exists();

        return response()->json([
            'success' => true,
            'isFavorite' => $isFavorite
        ]);
    }
}
