<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        // Exemple : afficher les 6 premiers produits (ou filtrer par promotion si champ on_sale existe)
        $products = Product::take(6)->get();
        return view('home', compact('products'));
    }
}
