@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h3 mb-0">
                    <i class="fas fa-heart text-danger me-2"></i>
                    Mes Favoris
                </h2>
                <a href="{{ route('products.index') }}" class="btn btn-outline-primary">
                    <i class="fas fa-plus me-1"></i>Découvrir des produits
                </a>
            </div>

            @if($favorites->count() > 0)
                <div class="row g-4">
                    @foreach($favorites as $product)
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="card h-100 shadow-sm product-card" data-product-id="{{ $product->id }}">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                                @else
                                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                        <i class="fas fa-image fa-3x text-muted"></i>
                                    </div>
                                @endif
                                
                                <div class="card-body d-flex flex-column">
                                    <h6 class="card-title">{{ $product->name }}</h6>
                                    <p class="text-muted small mb-2">{{ $product->category->name ?? 'Sans catégorie' }}</p>
                                    <p class="text-primary fw-bold mb-3">{{ number_format($product->price, 2) }} DH</p>
                                    
                                    <div class="mt-auto">
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('products.show', $product) }}" class="btn btn-primary btn-sm flex-fill">
                                                <i class="fas fa-eye me-1"></i>Voir
                                            </a>
                                            <button class="btn btn-outline-danger btn-sm" onclick="removeFavorite({{ $product->id }}, this)">
                                                <i class="fas fa-heart"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $favorites->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-heart fa-4x text-muted mb-3"></i>
                    <h4 class="text-muted mb-3">Aucun favori encore</h4>
                    <p class="text-muted mb-4">Vous n'avez pas encore ajouté de produits à vos favoris.</p>
                    <a href="{{ route('products.index') }}" class="btn btn-primary">
                        <i class="fas fa-search me-1"></i>Découvrir des produits
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
.product-card {
    transition: transform 0.2s ease-in-out;
}

.product-card:hover {
    transform: translateY(-5px);
}

.card-img-top {
    border-bottom: 1px solid #dee2e6;
}
</style>

<script>
// Fonction pour supprimer un favori
function removeFavorite(productId, button) {
    if (confirm('Êtes-vous sûr de vouloir retirer ce produit de vos favoris ?')) {
        const productCard = button.closest('.product-card');
        
        fetch(`/favorites/remove/${productId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Supprimer la carte du produit
                productCard.remove();
                
                // Afficher un message de succès
                showNotification('Produit retiré des favoris', 'success');
                
                // Vérifier s'il reste des favoris
                const remainingCards = document.querySelectorAll('.product-card');
                if (remainingCards.length === 0) {
                    location.reload(); // Recharger pour afficher le message "aucun favori"
                }
            } else {
                showNotification('Erreur lors de la suppression', 'error');
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            showNotification('Une erreur est survenue', 'error');
        });
    }
}

// Fonction pour afficher les notifications
function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = `alert alert-${type === 'success' ? 'success' : 'danger'} alert-dismissible fade show position-fixed`;
    notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
    notification.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    document.body.appendChild(notification);
    
    // Supprimer automatiquement après 3 secondes
    setTimeout(() => {
        if (notification.parentNode) {
            notification.remove();
        }
    }, 3000);
}
</script>
@endsection
