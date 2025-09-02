<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = \App\Models\Product::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%$search%")
                  ->orWhere('description', 'like', "%$search%");
        }

        // Category filter
        if ($request->filled('category')) {
            $query->where('category_id', $request->input('category'));
        }

        // Sort functionality
        if ($request->filled('sort')) {
            switch ($request->input('sort')) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
                default:
                    $query->latest();
            }
        } else {
            $query->latest();
        }

        $products = $query->with('category')->paginate(12);
        $categories = Category::all();

        return view('products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $validated['image'] = $path;
        }

        $validated['seller_id'] = auth()->id(); // ou à adapter selon le contexte
        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Produit créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        
        // Récupérer les produits similaires (même catégorie, excluant le produit actuel)
        $similarProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('stock', '>', 0)
            ->latest()
            ->take(4)
            ->get();
        
        return view('products.show', compact('product', 'similarProducts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        
        // Vérifier l'autorisation : seul le propriétaire ou un admin peut modifier
        if (auth()->user()->role !== 'admin' && $product->seller_id !== auth()->id()) {
            return redirect()->route('products.index')->with('error', 'Vous n\'êtes pas autorisé à modifier ce produit.');
        }
        
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
        
        // Vérifier l'autorisation : seul le propriétaire ou un admin peut modifier
        if (auth()->user()->role !== 'admin' && $product->seller_id !== auth()->id()) {
            return redirect()->route('products.index')->with('error', 'Vous n\'êtes pas autorisé à modifier ce produit.');
        }
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $validated['image'] = $path;
        }

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Produit modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        // Vérifier l'autorisation : seul le propriétaire ou un admin peut supprimer
        if (auth()->user()->role !== 'admin' && $product->seller_id !== auth()->id()) {
            return redirect()->route('products.index')->with('error', 'Vous n\'êtes pas autorisé à supprimer ce produit.');
        }
        
        $categoryId = $product->category_id;
        $product->delete();
        
        // Si on vient d'une catégorie spécifique, retourner aux produits filtrés par catégorie
        if ($request->has('from_category')) {
            return redirect()->route('products.index', ['category' => $request->from_category])->with('success', 'Produit supprimé avec succès.');
        }
        
        // Sinon retourner à la liste générale des produits
        return redirect()->route('products.index')->with('success', 'Produit supprimé avec succès.');
    }
}
