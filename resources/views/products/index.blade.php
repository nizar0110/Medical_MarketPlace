@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Messages de succès/erreur -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- En-tête avec recherche -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h2 mb-0">
                        @if(request('category'))
                            @php
                                $selectedCategory = App\Models\Category::find(request('category'));
                            @endphp
                            @if($selectedCategory)
                                {{ $selectedCategory->name }}
                            @else
                                Nos Produits
                            @endif
                        @else
                            Nos Produits
                        @endif
                    </h1>
                    @if(request('category') && $selectedCategory)
                        <p class="text-muted mb-0">{{ $selectedCategory->description ?? 'Produits de cette catégorie' }}</p>
                    @endif
                </div>
                <form action="{{ route('products.index') }}" method="GET" class="d-flex" style="max-width: 300px;">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher..." class="form-control me-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Filtres et tri -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('products.index') }}" method="GET" class="row g-3">
                        <!-- Search -->
                        <div class="col-md-4">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher un produit..." class="form-control">
                        </div>
                        
                        <!-- Category Filter -->
                        <div class="col-md-3">
                            <select name="category" class="form-select">
                                <option value="">Toutes les catégories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Sort -->
                        <div class="col-md-3">
                            <select name="sort" class="form-select">
                                <option value="">Trier par</option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Prix croissant</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Prix décroissant</option>
                                <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nom A-Z</option>
                                <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nom Z-A</option>
                            </select>
                        </div>
                        
                        <!-- Submit -->
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-filter me-1"></i>Filtrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Results count -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <span class="text-muted">{{ $products->total() }} produits trouvés</span>
                @if(request('category') || request('search') || request('sort'))
                    <div class="d-flex gap-2">
                        @if(request('category'))
                            <a href="{{ route('products.index') }}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-list me-1"></i>Tous les produits
                            </a>
                        @endif
                        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-times me-1"></i>Effacer les filtres
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Grille des produits -->
    <div class="row g-4">
        @forelse($products as $product)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card h-100 shadow-sm hover-shadow">
                    @if($product->image)
                        @if(Str::startsWith($product->image, 'http'))
                            <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                        @else
                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                        @endif
                    @else
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                            <i class="fas fa-image fa-3x text-muted"></i>
                        </div>
                    @endif
                    
                    <div class="card-body d-flex flex-column">
                        <!-- Category badge -->
                        @if($product->category)
                            <span class="badge bg-info mb-2">{{ $product->category->name }}</span>
                        @endif
                        
                        <h5 class="card-title fw-bold">{{ $product->name }}</h5>
                        <p class="card-text text-muted small">{{ Str::limit($product->description, 80) }}</p>
                        
                        <div class="mt-auto">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="h5 text-primary mb-0">{{ number_format($product->price, 2) }} DH</span>
                                <span class="badge bg-{{ $product->stock > 0 ? 'success' : 'danger' }}">
                                    {{ $product->stock > 0 ? 'En stock' : 'Rupture' }}
                                </span>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <a href="{{ route('products.show', $product) }}" class="btn btn-primary">
                                    <i class="fas fa-eye me-1"></i>Voir
                                </a>
                                
                                @auth
                                    @if(Auth::user()->role === 'admin' || (Auth::user()->role === 'seller' && Auth::user()->id === $product->seller_id))
                                        <div class="d-grid gap-2">
                                            <a href="{{ route('products.edit', $product) }}" class="btn btn-warning">
                                                <i class="fas fa-edit me-1"></i>Modifier
                                            </a>
                                            
                                            <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">
                                                @csrf
                                                @method('DELETE')
                                                @if(request('category'))
                                                    <input type="hidden" name="from_category" value="{{ request('category') }}">
                                                @endif
                                                <button type="submit" class="btn btn-danger w-100">
                                                    <i class="fas fa-trash me-1"></i>Supprimer
                                                </button>
                                            </form>
                                        </div>
                                    @elseif($product->stock > 0 && Auth::user()->role === 'client')
                                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="btn btn-success w-100">
                                                <i class="fas fa-cart-plus me-1"></i>Panier
                                            </button>
                                        </form>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-outline-primary">
                                        <i class="fas fa-sign-in-alt me-1"></i>Se connecter
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-search fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">Aucun produit trouvé</h4>
                    <p class="text-muted">Essayez de modifier vos critères de recherche</p>
                    <a href="{{ route('products.index') }}" class="btn btn-primary">Voir tous les produits</a>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($products->hasPages())
        <div class="row mt-4">
            <div class="col-12">
                <nav aria-label="Navigation des produits">
                    {{ $products->links() }}
                </nav>
            </div>
        </div>
    @endif
</div>

<style>
.hover-shadow:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
    transition: all 0.3s ease;
}

.card {
    transition: all 0.3s ease;
}
</style>
@endsection 