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
        </>
    );
}
