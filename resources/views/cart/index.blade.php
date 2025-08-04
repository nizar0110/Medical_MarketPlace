@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="h2 mb-4">Mon Panier</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(count($cartItems) > 0)
        <div class="row">
            <!-- Liste des produits -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Produits dans le panier</h5>
                    </div>
                    <div class="card-body">
                        @foreach($cartItems as $item)
                            <div class="row align-items-center border-bottom pb-3 mb-3">
                                <div class="col-md-2">
                                    @if($item['product']->image)
                                        <img src="{{ asset('storage/' . $item['product']->image) }}" class="img-fluid rounded" alt="{{ $item['product']->name }}">
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 80px;">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="col-md-4">
                                    <h6 class="fw-bold mb-1">{{ $item['product']->name }}</h6>
                                    <p class="text-muted small mb-0">{{ Str::limit($item['product']->description, 50) }}</p>
                                </div>
                                
                                <div class="col-md-2">
                                    <span class="text-primary fw-bold">{{ number_format($item['product']->price, 2) }} DH</span>
                                </div>
                                
                                <div class="col-md-2">
                                    <div class="input-group input-group-sm">
                                        <button class="btn btn-outline-secondary" type="button" onclick="updateQuantity({{ $item['product']->id }}, -1)">-</button>
                                        <input type="number" class="form-control text-center" value="{{ $item['quantity'] }}" min="1" max="{{ $item['product']->stock }}" onchange="updateQuantity({{ $item['product']->id }}, 0, this.value)">
                                        <button class="btn btn-outline-secondary" type="button" onclick="updateQuantity({{ $item['product']->id }}, 1)">+</button>
                                    </div>
                                </div>
                                
                                <div class="col-md-1">
                                    <span class="fw-bold">{{ number_format($item['product']->price * $item['quantity'], 2) }} DH</span>
                                </div>
                                
                                <div class="col-md-1">
                                    <form action="{{ route('cart.remove', $item['product']->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Supprimer ce produit du panier ?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Résumé de la commande -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Résumé de la commande</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Sous-total :</span>
                            <span>{{ number_format($total, 2) }} DH</span>
                        </div>
                        
                        <div class="d-flex justify-content-between mb-2">
                            <span>Livraison :</span>
                            <span>Gratuit</span>
                        </div>
                        
                        <hr>
                        
                        <div class="d-flex justify-content-between mb-3">
                            <span class="fw-bold">Total :</span>
                            <span class="fw-bold text-primary fs-5">{{ number_format($total, 2) }} DH</span>
                        </div>
                        
                        <div class="mb-3">
                            <label for="promoCode" class="form-label">Code promo :</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="promoCode" placeholder="Entrez votre code">
                                <button class="btn btn-outline-secondary" type="button">Appliquer</button>
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <a href="{{ route('payment.checkout') }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-credit-card me-2"></i>Procéder au paiement
                            </a>
                            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Continuer les achats
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Informations de sécurité -->
                <div class="card mt-3">
                    <div class="card-body">
                        <h6 class="card-title">
                            <i class="fas fa-shield-alt text-success me-2"></i>Paiement sécurisé
                        </h6>
                        <p class="card-text small text-muted">
                            Vos informations de paiement sont protégées par un cryptage SSL de 256 bits.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-5">
            <i class="fas fa-shopping-cart fa-4x text-muted mb-4"></i>
            <h3 class="text-muted mb-3">Votre panier est vide</h3>
            <p class="text-muted mb-4">Découvrez nos produits et commencez vos achats</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-shopping-bag me-2"></i>Voir les produits
            </a>
        </div>
    @endif
</div>

<script>
function updateQuantity(productId, change, newValue = null) {
    let quantity;
    if (newValue !== null) {
        quantity = parseInt(newValue);
    } else {
        const input = event.target.parentNode.querySelector('input');
        quantity = parseInt(input.value) + change;
    }
    
    if (quantity < 1) quantity = 1;
    
    fetch(`/cart/${productId}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ quantity: quantity })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
    });
}
</script>
@endsection 