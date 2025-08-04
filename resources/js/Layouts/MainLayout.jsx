// resources/js/Components/Layouts/MainLayout.jsx
import React from 'react';

export default function MainLayout({ children }) {
    return (
        <>
            {/* Header/Navbar */}
            <header className="bg-light shadow-sm">
                <nav className="container d-flex justify-content-between align-items-center py-3">
                    <h3 className="m-0">🩺 Medical Market</h3>
                    <ul className="nav">
                        <li className="nav-item"><a href="/" className="nav-link">Accueil</a></li>
                        <li className="nav-item"><a href="/produits" className="nav-link">Produits</a></li>
                        <li className="nav-item"><a href="/assistant" className="nav-link">Assistant</a></li>
                        <li className="nav-item"><a href="/login" className="nav-link">Connexion</a></li>
                    </ul>
                </nav>
            </header>

            {/* Contenu central */}
            <main className="container my-5">
                {children}
            </main>

            {/* Footer Professionnel */}
            <footer className="bg-dark text-white">
                {/* Section principale du footer */}
                <div className="container py-5">
                    <div className="row">
                        {/* À propos de Medical Market */}
                        <div className="col-lg-4 col-md-6 mb-4">
                            <h5 className="fw-bold mb-3">
                                <i className="fas fa-heartbeat me-2 text-primary"></i>
                                Medical Market
                            </h5>
                            <p className="text-muted mb-3">
                                Votre plateforme de confiance pour tous vos besoins médicaux. 
                                Nous proposons une large gamme de produits médicaux de qualité 
                                auprès de fournisseurs certifiés.
                            </p>
                            <div className="d-flex gap-3">
                                <a href="#" className="text-white text-decoration-none">
                                    <i className="fab fa-facebook-f fa-lg"></i>
                                </a>
                                <a href="#" className="text-white text-decoration-none">
                                    <i className="fab fa-twitter fa-lg"></i>
                                </a>
                                <a href="#" className="text-white text-decoration-none">
                                    <i className="fab fa-linkedin-in fa-lg"></i>
                                </a>
                                <a href="#" className="text-white text-decoration-none">
                                    <i className="fab fa-instagram fa-lg"></i>
                                </a>
                            </div>
                        </div>

                        {/* Liens rapides */}
                        <div className="col-lg-2 col-md-6 mb-4">
                            <h6 className="fw-bold mb-3">Liens Rapides</h6>
                            <ul className="list-unstyled">
                                <li className="mb-2">
                                    <a href="/" className="text-muted text-decoration-none">
                                        <i className="fas fa-home me-2"></i>Accueil
                                    </a>
                                </li>
                                <li className="mb-2">
                                    <a href="/produits" className="text-muted text-decoration-none">
                                        <i className="fas fa-pills me-2"></i>Produits
                                    </a>
                                </li>
                                <li className="mb-2">
                                    <a href="/assistant" className="text-muted text-decoration-none">
                                        <i className="fas fa-robot me-2"></i>Assistant IA
                                    </a>
                                </li>
                                <li className="mb-2">
                                    <a href="/categories" className="text-muted text-decoration-none">
                                        <i className="fas fa-th-large me-2"></i>Catégories
                                    </a>
                                </li>
                            </ul>
                        </div>

                        {/* Services */}
                        <div className="col-lg-2 col-md-6 mb-4">
                            <h6 className="fw-bold mb-3">Services</h6>
                            <ul className="list-unstyled">
                                <li className="mb-2">
                                    <a href="#" className="text-muted text-decoration-none">
                                        <i className="fas fa-shipping-fast me-2"></i>Livraison
                                    </a>
                                </li>
                                <li className="mb-2">
                                    <a href="#" className="text-muted text-decoration-none">
                                        <i className="fas fa-shield-alt me-2"></i>Garantie
                                    </a>
                                </li>
                                <li className="mb-2">
                                    <a href="#" className="text-muted text-decoration-none">
                                        <i className="fas fa-undo me-2"></i>Retours
                                    </a>
                                </li>
                                <li className="mb-2">
                                    <a href="#" className="text-muted text-decoration-none">
                                        <i className="fas fa-headset me-2"></i>Support
                                    </a>
                                </li>
                            </ul>
                        </div>

                        {/* Contact */}
                        <div className="col-lg-4 col-md-6 mb-4">
                            <h6 className="fw-bold mb-3">Contact</h6>
                            <div className="mb-3">
                                <i className="fas fa-map-marker-alt me-2 text-primary"></i>
                                <span className="text-muted">123 Rue de la Santé, Casablanca, Maroc</span>
                            </div>
                            <div className="mb-3">
                                <i className="fas fa-phone me-2 text-primary"></i>
                                <span className="text-muted">+212 5 22 123 456</span>
                            </div>
                            <div className="mb-3">
                                <i className="fas fa-envelope me-2 text-primary"></i>
                                <span className="text-muted">contact@medicalmarket.ma</span>
                            </div>
                            <div className="mb-3">
                                <i className="fas fa-clock me-2 text-primary"></i>
                                <span className="text-muted">Lun-Ven: 8h-18h, Sam: 9h-16h</span>
                            </div>
                        </div>
                    </div>
                </div>

                {/* Section inférieure du footer */}
                <div className="border-top border-secondary">
                    <div className="container py-3">
                        <div className="row align-items-center">
                            <div className="col-md-6 text-center text-md-start">
                                <p className="mb-0 text-muted">
                                    © 2025 Medical Market. Tous droits réservés.
                                </p>
                            </div>
                            <div className="col-md-6 text-center text-md-end">
                                <div className="d-flex justify-content-center justify-content-md-end gap-3">
                                    <a href="#" className="text-muted text-decoration-none small">
                                        Politique de confidentialité
                                    </a>
                                    <a href="#" className="text-muted text-decoration-none small">
                                        Conditions d'utilisation
                                    </a>
                                    <a href="#" className="text-muted text-decoration-none small">
                                        Mentions légales
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </>
    );
}
