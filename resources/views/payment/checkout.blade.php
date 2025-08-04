@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-credit-card me-2"></i>Finaliser la commande
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('payment.process') }}" method="POST" id="payment-form">
                        @csrf
                        
                        <!-- Informations de livraison -->
                        <div class="mb-4">
                            <h5 class="border-bottom pb-2">
                                <i class="fas fa-shipping-fast me-2"></i>Informations de livraison
                            </h5>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="shipping_address" class="form-label fw-bold">Adresse de livraison</label>
                                    <textarea 
                                        class="form-control @error('shipping_address') is-invalid @enderror" 
                                        id="shipping_address" 
                                        name="shipping_address" 
                                        rows="3" 
                                        placeholder="Entrez votre adresse complète de livraison"
                                        required
                                    >{{ old('shipping_address') }}</textarea>
                                    @error('shipping_address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="shipping_phone" class="form-label fw-bold">Téléphone</label>
                                    <input 
                                        type="tel" 
                                        class="form-control @error('shipping_phone') is-invalid @enderror" 
                                        id="shipping_phone" 
                                        name="shipping_phone" 
                                        placeholder="Ex: 0600000000"
                                        value="{{ old('shipping_phone') }}"
                                        required
                                    >
                                    @error('shipping_phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Méthode de paiement -->
                        <div class="mb-4">
                            <h5 class="border-bottom pb-2">
                                <i class="fas fa-credit-card me-2"></i>Méthode de paiement
                            </h5>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method" id="card" value="card" {{ old('payment_method') == 'card' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="card">
                                            <i class="fas fa-credit-card me-2"></i>Paiement par carte
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method" id="cash_on_delivery" value="cash_on_delivery" {{ old('payment_method') == 'cash_on_delivery' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="cash_on_delivery">
                                            <i class="fas fa-money-bill-wave me-2"></i>Paiement à la livraison
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Informations de carte (affichées conditionnellement) -->
                            <div id="card-details" class="mt-3" style="display: none;">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="card_number" class="form-label">Numéro de carte</label>
                                        <input 
                                            type="text" 
                                            class="form-control @error('card_number') is-invalid @enderror" 
                                            id="card_number" 
                                            name="card_number" 
                                            placeholder="1234 5678 9012 3456"
                                            maxlength="16"
                                        >
                                        @error('card_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-3 mb-3">
                                        <label for="card_expiry" class="form-label">Expiration</label>
                                        <input 
                                            type="text" 
                                            class="form-control @error('card_expiry') is-invalid @enderror" 
                                            id="card_expiry" 
                                            name="card_expiry" 
                                            placeholder="MM/YY"
                                            maxlength="5"
                                        >
                                        @error('card_expiry')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-3 mb-3">
                                        <label for="card_cvv" class="form-label">CVV</label>
                                        <input 
                                            type="text" 
                                            class="form-control @error('card_cvv') is-invalid @enderror" 
                                            id="card_cvv" 
                                            name="card_cvv" 
                                            placeholder="123"
                                            maxlength="3"
                                        >
                                        @error('card_cvv')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Bouton de paiement -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-lock me-2"></i>Confirmer et payer {{ number_format($total, 2) }} DH
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Résumé de la commande -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Résumé de votre commande</h5>
                </div>
                <div class="card-body">
                    @foreach($cartItems as $item)
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <h6 class="mb-0">{{ $item['product']->name }}</h6>
                                <small class="text-muted">Quantité: {{ $item['quantity'] }}</small>
                            </div>
                            <span class="fw-bold">{{ number_format($item['subtotal'], 2) }} DH</span>
                        </div>
                    @endforeach
                    
                    <hr>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span>Sous-total:</span>
                        <span>{{ number_format($total, 2) }} DH</span>
                    </div>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span>Livraison:</span>
                        <span class="text-success">Gratuit</span>
                    </div>
                    
                    <hr>
                    
                    <div class="d-flex justify-content-between">
                        <span class="fw-bold fs-5">Total:</span>
                        <span class="fw-bold fs-5 text-primary">{{ number_format($total, 2) }} DH</span>
                    </div>
                </div>
            </div>

            <!-- Sécurité -->
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
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const cardRadio = document.getElementById('card');
    const cardDetails = document.getElementById('card-details');
    
    // Show/hide card details based on payment method
    function toggleCardDetails() {
        if (cardRadio.checked) {
            cardDetails.style.display = 'block';
        } else {
            cardDetails.style.display = 'none';
        }
    }
    
    // Add event listeners
    document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
        radio.addEventListener('change', toggleCardDetails);
    });
    
    // Initial state
    toggleCardDetails();
    
    // Card number formatting
    const cardNumber = document.getElementById('card_number');
    if (cardNumber) {
        cardNumber.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            e.target.value = value;
        });
    }
    
    // CVV formatting
    const cardCvv = document.getElementById('card_cvv');
    if (cardCvv) {
        cardCvv.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            e.target.value = value;
        });
    }
    
    // Expiry date formatting
    const cardExpiry = document.getElementById('card_expiry');
    if (cardExpiry) {
        cardExpiry.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length >= 2) {
                value = value.substring(0, 2) + '/' + value.substring(2);
            }
            e.target.value = value;
        });
    }
});
</script>
@endsection 