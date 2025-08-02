<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ChatbotController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes publiques pour le chatbot
Route::post('/chatbot/chat', [ChatbotController::class, 'chat'])->name('chatbot.chat');
Route::get('/chatbot', [ChatbotController::class, 'index'])->name('chatbot.index');

Route::get('/categories/{category}', [\App\Http\Controllers\CategoryController::class, 'show'])->name('categories.show');

// Routes publiques pour les produits
Route::resource('products', ProductController::class);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Routes pour les catégories
    Route::resource('categories', CategoryController::class);
    
    // Routes pour le panier
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/{item}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{item}', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/cart', [CartController::class, 'clear'])->name('cart.clear');
    
    // Routes pour les tableaux de bord
    Route::get('/seller/dashboard', function () {
        $user = auth()->user();
        
        // Produits récents
        $recentProducts = $user->products()->latest()->take(5)->get();
        $productsCount = $user->products()->count();
        
        // Calcul des revenus et commandes (à adapter selon votre logique métier)
        $ordersCount = 0; // Placeholder - à remplacer par la vraie logique
        $revenue = 0; // Placeholder - à remplacer par la vraie logique
        $monthlyRevenue = 0; // Placeholder - à remplacer par la vraie logique
        $recentOrders = []; // Placeholder - à remplacer par la vraie logique
        
        // Exemple de calcul des revenus (à adapter)
        // $revenue = $user->products()->with('orderItems')->get()->sum(function($product) {
        //     return $product->orderItems->sum(function($item) {
        //         return $item->quantity * $item->price;
        //     });
        // });
        
        return view('seller.dashboard', compact(
            'recentProducts', 
            'productsCount', 
            'ordersCount', 
            'revenue', 
            'monthlyRevenue',
            'recentOrders'
        ));
    })->name('seller.dashboard')->middleware('role:seller');
    
    Route::get('/client/dashboard', function () {
        return view('client.dashboard');
    })->name('client.dashboard')->middleware('role:client');
    
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard')->middleware('role:admin');
});

require __DIR__.'/auth.php';
