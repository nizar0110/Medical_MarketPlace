@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Breadcrumbs -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Accueil</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produits</a></li>
            <li class="breadcrumb-item active">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Image du produit -->
        <div class="col-lg-6 mb-4">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded shadow" alt="{{ $product->name }}">
            @else
                <div class="bg-light rounded shadow d-flex align-items-center justify-content-center" style="height: 400px;">
                    <i class="fas fa-image fa-4x text-muted"></i>
                </div>
            @endif
        </div>

        <!-- Informations du produit -->
        <div class="col-lg-6">
            <h1 class="h2 fw-bold mb-3">{{ $product->name }}</h1>
            
            <div class="mb-3">
                <span class="h3 text-primary fw-bold">{{ number_format($product->price, 2) }} DH</span>
                @if($product->stock > 0)
                    <span class="badge bg-success ms-2">En stock ({{ $product->stock }})</span>
                @else
                    <span class="badge bg-danger ms-2">Rupture de stock</span>
                @endif
            </div>

            <div class="mb-4">
                <h6 class="fw-bold">Description :</h6>
                <p class="text-muted">{{ $product->description }}</p>
            </div>

            <div class="row mb-4">
                <div class="col-6">
                    <h6 class="fw-bold">Catégorie :</h6>
                    <p class="text-muted">{{ $product->category->name ?? 'Non catégorisé' }}</p>
                </div>
                <div class="col-6">
                    <h6 class="fw-bold">Vendeur :</h6>
                    <p class="text-muted">{{ $product->seller->name ?? 'Anonyme' }}</p>
                </div>
            </div>

            @if($product->stock > 0 && auth()->check() && auth()->user()->role === 'client')
                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mb-4">
                    @csrf
                    <div class="row align-items-end">
                        <div class="col-md-4 mb-3">
                            <label for="quantity" class="form-label fw-bold">Quantité :</label>
                            <div class="input-group">
                                <button type="button" class="btn btn-outline-secondary" onclick="decreaseQuantity()">-</button>
                                <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock }}" class="form-control text-center">
                                <button type="button" class="btn btn-outline-secondary" onclick="increaseQuantity()">+</button>
                            </div>
                        </div>
                        <div class="col-md-8 mb-3">
                            <button type="submit" class="btn btn-primary btn-lg w-100">
                                <i class="fas fa-cart-plus me-2"></i>Ajouter au panier
                            </button>
                        </div>
                    </div>
                </form>
            @elseif($product->stock > 0 && auth()->check() && auth()->user()->role === 'seller')
                <div class="alert alert-info mb-4">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Accès vendeur :</strong> En tant que vendeur, vous ne pouvez pas ajouter de produits au panier.
                    <div class="mt-2">
                        @if(auth()->user()->id === $product->seller_id)
                            <a href="{{ route('products.edit', $product) }}" class="btn btn-outline-primary btn-sm me-2">
                                <i class="fas fa-edit me-1"></i>Modifier
                            </a>
                        @endif
                        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-list me-1"></i>Voir tous les produits
                        </a>
                    </div>
                </div>
            @elseif($product->stock <= 0)
                <div class="alert alert-warning mb-4">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Rupture de stock :</strong> Ce produit n'est plus disponible pour le moment.
                </div>
            @elseif(!auth()->check())
                <div class="alert alert-info mb-4">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Connexion requise :</strong> Vous devez être connecté pour ajouter des produits au panier.
                    <div class="mt-2">
                        <a href="{{ route('login') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-sign-in-alt me-1"></i>Se connecter
                        </a>
                    </div>
                </div>
            @endif

            <!-- Actions supplémentaires -->
            <div class="d-flex gap-2 mb-4">
                <button class="btn btn-outline-primary">
                    <i class="fas fa-heart me-1"></i>Favoris
                </button>
                <button class="btn btn-outline-secondary">
                    <i class="fas fa-share me-1"></i>Partager
                </button>
            </div>

            <!-- Informations supplémentaires -->
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title fw-bold">Informations supplémentaires</h6>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <i class="fas fa-shipping-fast text-primary me-2"></i>
                            Livraison gratuite à partir de 1000 DH
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-shield-alt text-primary me-2"></i>
                            Garantie 2 ans sur tous les produits
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-undo text-primary me-2"></i>
                            Retour sous 30 jours
                        </li>
                        <li>
                            <i class="fas fa-headset text-primary me-2"></i>
                            Support client 24/7
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Produits similaires -->
    <div class="mt-5">
        <h3 class="h4 fw-bold mb-4">Produits similaires</h3>
        <div class="row g-4">
            @if(isset($similarProducts) && $similarProducts->count() > 0)
                @foreach($similarProducts->take(4) as $similarProduct)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="card h-100 shadow-sm">
                        @if($similarProduct->image)
                            <img src="{{ asset('storage/' . $similarProduct->image) }}" class="card-img-top" alt="{{ $similarProduct->name }}" style="height: 150px; object-fit: cover;">
                        @else
                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 150px;">
                                <i class="fas fa-image fa-2x text-muted"></i>
                            </div>
                        @endif
                        
                        <div class="card-body">
                            <h6 class="card-title">{{ $similarProduct->name }}</h6>
                            <p class="text-primary fw-bold mb-2">{{ number_format($similarProduct->price, 2) }} DH</p>
                            <a href="{{ route('products.show', $similarProduct) }}" class="btn btn-outline-primary btn-sm">Voir</a>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="col-12">
                    <div class="text-center py-4">
                        <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Aucun produit similaire disponible pour le moment.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
function decreaseQuantity() {
    const input = document.getElementById('quantity');
    const currentValue = parseInt(input.value);
    if (currentValue > 1) {
        input.value = currentValue - 1;
    }
}

function increaseQuantity() {
    const input = document.getElementById('quantity');
    const currentValue = parseInt(input.value);
    const maxValue = parseInt(input.getAttribute('max'));
    if (currentValue < maxValue) {
        input.value = currentValue + 1;
    }
}
</script>
@endsection 