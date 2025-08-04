@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card border-danger">
                <div class="card-header bg-danger text-white text-center">
                    <i class="fas fa-times-circle fa-3x mb-3"></i>
                    <h3 class="mb-0">Paiement échoué</h3>
                    <p class="mb-0">Une erreur est survenue lors du traitement de votre paiement</p>
                </div>
                <div class="card-body text-center">
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Attention:</strong> Votre commande n'a pas été traitée. Veuillez réessayer.
                    </div>

                    <p class="text-muted">
                        Si le problème persiste, veuillez vérifier vos informations de paiement ou 
                        contacter notre service client.
                    </p>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                        <a href="{{ route('cart.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-shopping-cart me-2"></i>Retour au panier
                        </a>
                        <a href="{{ route('products.index') }}" class="btn btn-primary">
                            <i class="fas fa-shopping-bag me-2"></i>Continuer les achats
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 