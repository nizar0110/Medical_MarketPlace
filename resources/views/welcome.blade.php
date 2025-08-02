@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="position-relative min-vh-100 d-flex align-items-center justify-content-center">
    <div class="position-absolute top-0 start-0 w-100 h-100">
        <img src="{{ asset('images/medical-background.jpg') }}" alt="Medical Equipment" class="w-100 h-100 object-fit-cover">
        <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-60"></div>
    </div>
    
    <div class="position-relative text-center text-white container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="display-3 fw-bold mb-4">Bienvenue sur Medical Marketplace</h1>
                <p class="lead mb-5">Votre plateforme de confiance pour tous vos besoins en équipements et produits médicaux. Qualité, sécurité et service au cœur de notre mission.</p>
                
                <div class="d-flex justify-content-center gap-3 mb-5">
                    <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg px-4 py-3">
                        <i class="fas fa-search me-2"></i>Découvrir nos produits
                    </a>
                    @guest
                        <a href="{{ route('register.with.role') }}" class="btn btn-success btn-lg px-4 py-3">
                            <i class="fas fa-user-plus me-2"></i>S'inscrire
                        </a>
                        <a href="#" class="btn btn-outline-light btn-lg px-4 py-3" onclick="document.getElementById('chatbot-toggle').click(); return false;">
                            <i class="fas fa-robot me-2"></i>Parler à l'assistant
                        </a>
                    @endguest
                </div>
                
                <!-- Statistiques -->
                <div class="row text-center">
                    <div class="col-md-3 mb-3">
                        <div class="bg-white bg-opacity-20 rounded p-3">
                            <h3 class="fw-bold mb-1">500+</h3>
                            <p class="mb-0">Produits médicaux</p>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="bg-white bg-opacity-20 rounded p-3">
                            <h3 class="fw-bold mb-1">50+</h3>
                            <p class="mb-0">Fournisseurs certifiés</p>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="bg-white bg-opacity-20 rounded p-3">
                            <h3 class="fw-bold mb-1">1000+</h3>
                            <p class="mb-0">Clients satisfaits</p>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="bg-white bg-opacity-20 rounded p-3">
                            <h3 class="fw-bold mb-1">24/7</h3>
                            <p class="mb-0">Support client</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Section Catégories -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold mb-3">Nos Catégories</h2>
            <p class="lead text-muted">Découvrez notre gamme complète de produits médicaux organisés par catégories</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm hover-shadow">
                    <div class="card-body text-center p-4">
                        <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="fas fa-heartbeat fa-2x text-primary"></i>
                        </div>
                        <h5 class="card-title fw-bold">Cardiologie</h5>
                        <p class="card-text text-muted">Équipements et dispositifs pour la santé cardiovasculaire</p>
                        <a href="{{ route('categories.show', 1) }}" class="btn btn-outline-primary">Voir les produits</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm hover-shadow">
                    <div class="card-body text-center p-4">
                        <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="fas fa-brain fa-2x text-success"></i>
                        </div>
                        <h5 class="card-title fw-bold">Neurologie</h5>
                        <p class="card-text text-muted">Instruments et dispositifs pour la neurologie</p>
                        <a href="{{ route('categories.show', 2) }}" class="btn btn-outline-success">Voir les produits</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm hover-shadow">
                    <div class="card-body text-center p-4">
                        <div class="bg-info bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="fas fa-eye fa-2x text-info"></i>
                        </div>
                        <h5 class="card-title fw-bold">Ophtalmologie</h5>
                        <p class="card-text text-muted">Équipements pour la santé oculaire</p>
                        <a href="{{ route('categories.show', 3) }}" class="btn btn-outline-info">Voir les produits</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm hover-shadow">
                    <div class="card-body text-center p-4">
                        <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="fas fa-bone fa-2x text-warning"></i>
                        </div>
                        <h5 class="card-title fw-bold">Orthopédie</h5>
                        <p class="card-text text-muted">Dispositifs et équipements orthopédiques</p>
                        <a href="{{ route('categories.show', 4) }}" class="btn btn-outline-warning">Voir les produits</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm hover-shadow">
                    <div class="card-body text-center p-4">
                        <div class="bg-danger bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="fas fa-stethoscope fa-2x text-danger"></i>
                        </div>
                        <h5 class="card-title fw-bold">Diagnostic</h5>
                        <p class="card-text text-muted">Instruments de diagnostic et de mesure</p>
                        <a href="{{ route('categories.show', 5) }}" class="btn btn-outline-danger">Voir les produits</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm hover-shadow">
                    <div class="card-body text-center p-4">
                        <div class="bg-secondary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="fas fa-pills fa-2x text-secondary"></i>
                        </div>
                        <h5 class="card-title fw-bold">Médicaments</h5>
                        <p class="card-text text-muted">Produits pharmaceutiques et médicaments</p>
                        <a href="{{ route('categories.show', 6) }}" class="btn btn-outline-secondary">Voir les produits</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section Avantages -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold mb-3">Pourquoi nous choisir ?</h2>
            <p class="lead text-muted">Nous nous engageons à vous offrir le meilleur service possible</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-3 text-center">
                <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                    <i class="fas fa-shipping-fast fa-lg text-primary"></i>
                </div>
                <h5 class="fw-bold">Livraison rapide</h5>
                <p class="text-muted">Livraison gratuite à partir de 1000 DH</p>
            </div>
            
            <div class="col-md-3 text-center">
                <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                    <i class="fas fa-shield-alt fa-lg text-success"></i>
                </div>
                <h5 class="fw-bold">Produits certifiés</h5>
                <p class="text-muted">Tous nos produits sont certifiés CE</p>
            </div>
            
            <div class="col-md-3 text-center">
                <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                    <i class="fas fa-headset fa-lg text-warning"></i>
                </div>
                <h5 class="fw-bold">Support 24/7</h5>
                <p class="text-muted">Assistance technique disponible</p>
            </div>
            
            <div class="col-md-3 text-center">
                <div class="bg-info bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                    <i class="fas fa-undo fa-lg text-info"></i>
                </div>
                <h5 class="fw-bold">Retour facile</h5>
                <p class="text-muted">Retour sous 30 jours</p>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-dark text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4">
                <h5 class="mb-3">Medical Marketplace</h5>
                <p class="text-muted">Votre partenaire de confiance pour tous vos besoins en équipements médicaux. Qualité, sécurité et innovation au service de la santé.</p>
                <div class="d-flex gap-3">
                    <a href="#" class="text-white"><i class="fab fa-facebook fa-lg"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-twitter fa-lg"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-linkedin fa-lg"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-instagram fa-lg"></i></a>
                </div>
            </div>
            
            <div class="col-lg-2 col-md-6 mb-4">
                <h6 class="mb-3">Produits</h6>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-muted text-decoration-none">Cardiologie</a></li>
                    <li><a href="#" class="text-muted text-decoration-none">Neurologie</a></li>
                    <li><a href="#" class="text-muted text-decoration-none">Ophtalmologie</a></li>
                    <li><a href="#" class="text-muted text-decoration-none">Orthopédie</a></li>
                </ul>
            </div>
            
            <div class="col-lg-2 col-md-6 mb-4">
                <h6 class="mb-3">Services</h6>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-muted text-decoration-none">Livraison</a></li>
                    <li><a href="#" class="text-muted text-decoration-none">Installation</a></li>
                    <li><a href="#" class="text-muted text-decoration-none">Maintenance</a></li>
                    <li><a href="#" class="text-muted text-decoration-none">Formation</a></li>
                </ul>
            </div>
            
            <div class="col-lg-2 col-md-6 mb-4">
                <h6 class="mb-3">Support</h6>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-muted text-decoration-none">Centre d'aide</a></li>
                    <li><a href="#" class="text-muted text-decoration-none">Contact</a></li>
                    <li><a href="#" class="text-muted text-decoration-none">FAQ</a></li>
                    <li><a href="#" class="text-muted text-decoration-none">Assistance</a></li>
                </ul>
            </div>
            
            <div class="col-lg-2 col-md-6 mb-4">
                <h6 class="mb-3">Entreprise</h6>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-muted text-decoration-none">À propos</a></li>
                    <li><a href="#" class="text-muted text-decoration-none">Carrières</a></li>
                    <li><a href="#" class="text-muted text-decoration-none">Presse</a></li>
                    <li><a href="#" class="text-muted text-decoration-none">Blog</a></li>
                </ul>
            </div>
        </div>
        
        <hr class="my-4">
        
        <div class="row align-items-center">
            <div class="col-md-6">
                <p class="mb-0 text-muted">&copy; 2024 Medical Marketplace. Tous droits réservés.</p>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="#" class="text-muted text-decoration-none me-3">Conditions d'utilisation</a>
                <a href="#" class="text-muted text-decoration-none me-3">Politique de confidentialité</a>
                <a href="#" class="text-muted text-decoration-none">Cookies</a>
            </div>
        </div>
    </div>
</footer>

<style>
.hover-shadow:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
    transition: all 0.3s ease;
}

.card {
    transition: all 0.3s ease;
}

.bg-opacity-10 {
    --bs-bg-opacity: 0.1;
}

.bg-opacity-20 {
    --bs-bg-opacity: 0.2;
}

.bg-opacity-60 {
    --bs-bg-opacity: 0.6;
}
</style>
@endsection
