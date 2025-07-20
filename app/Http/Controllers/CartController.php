<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Afficher le contenu du panier
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        $cartItems = [];
        $total = 0;

        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product) {
                $cartItems[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'subtotal' => $product->price * $quantity
                ];
                $total += $product->price * $quantity;
            }
        }

        return view('cart.index', compact('cartItems', 'total'));
    }

    /**
     * Ajouter un produit au panier
     */
    public function add(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$product->id])) {
            $cart[$product->id] += $request->quantity ?? 1;
        } else {
            $cart[$product->id] = $request->quantity ?? 1;
        }
        
        session()->put('cart', $cart);
        
        return redirect()->back()->with('success', 'Produit ajouté au panier !');
    }

    /**
     * Mettre à jour la quantité d'un produit
     */
    public function update(Request $request, $item)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$item])) {
            $quantity = $request->quantity;
            if ($quantity > 0) {
                $cart[$item] = $quantity;
            } else {
                unset($cart[$item]);
            }
            session()->put('cart', $cart);
        }
        
        return redirect()->route('cart.index')->with('success', 'Panier mis à jour !');
    }

    /**
     * Supprimer un produit du panier
     */
    public function remove($item)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$item])) {
            unset($cart[$item]);
            session()->put('cart', $cart);
        }
        
        return redirect()->route('cart.index')->with('success', 'Produit supprimé du panier !');
    }

    /**
     * Vider le panier
     */
    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'Panier vidé !');
    }
}
