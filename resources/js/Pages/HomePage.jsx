import React from 'react';
import MainLayout from '@/Layouts/MainLayout';

export default function HomePage() {
    return (
        <MainLayout>
            {/* Ici ton contenu de la page d'accueil */}
            <section className="text-center py-5">
                <h1 className="display-4">Bienvenue sur Medical Market</h1>
                <p className="lead">Trouvez les meilleurs produits médicaux au meilleur prix.</p>
                <div className="mt-4">
                    <a href="/produits" className="btn btn-primary me-3">Découvrir nos produits</a>
                    <a href="/login" className="btn btn-outline-secondary">Se connecter</a>
                </div>
            </section>

            {/* Stats Section */}
            <section className="row text-center mt-5">
                <div className="col-md-3"><h3>500+</h3><p>Produits médicaux</p></div>
                <div className="col-md-3"><h3>50+</h3><p>Fournisseurs</p></div>
                <div className="col-md-3"><h3>1000+</h3><p>Clients satisfaits</p></div>
                <div className="col-md-3"><h3>24/7</h3><p>Support client</p></div>
            </section>
        </MainLayout>
    );
}
