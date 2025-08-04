import React from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';
import { FaSearch, FaProductHunt, FaRobot, FaSignInAlt, FaShoppingCart, FaUsers, FaHeadset } from 'react-icons/fa';

const HomePage = () => {
  return (
    <div>
      {/* Navbar */}
      <nav className="navbar navbar-expand-lg navbar-light bg-white shadow-sm px-4">
        <a className="navbar-brand d-flex align-items-center" href="#">
          <img src="/logo.png" alt="Logo" width="40" height="40" className="me-2" />
          <strong>Medical Marketplace</strong>
        </a>
        <div className="mx-auto d-flex">
          <input className="form-control rounded-start" type="search" placeholder="Rechercher un produit..." />
          <button className="btn btn-primary rounded-end">
            <FaSearch />
          </button>
        </div>
        <ul className="navbar-nav ms-auto">
          <li className="nav-item mx-2">
            <a className="nav-link text-dark" href="#"><FaProductHunt /> Produits</a>
          </li>
          <li className="nav-item mx-2">
            <a className="nav-link text-dark" href="#"><FaRobot /> Assistant</a>
          </li>
          <li className="nav-item mx-2">
            <a className="nav-link text-dark" href="#"><FaSignInAlt /> Connexion</a>
          </li>
        </ul>
      </nav>

      {/* Hero Section */}
      <div
        className="text-center text-white py-5"
        style={{
          backgroundImage: "url('/bg-medical.jpg')",
          backgroundSize: 'cover',
          backgroundPosition: 'center',
          backgroundColor: 'rgba(0,0,0,0.6)',
          backgroundBlendMode: 'overlay'
        }}
      >
        <div className="container py-5">
          <h1 className="display-4 fw-bold">Bienvenue sur Medical Marketplace</h1>
          <p className="lead mt-3">
            Votre plateforme de confiance pour tous vos besoins en équipements et produits médicaux. <br />
            Qualité, sécurité et service au cœur de notre mission.
          </p>
          <div className="d-flex justify-content-center gap-3 mt-4 flex-wrap">
            <a href="#" className="btn btn-primary btn-lg">
              <FaShoppingCart className="me-2" />
              Découvrir nos produits
            </a>
            <a href="#" className="btn btn-outline-light btn-lg">
              <FaSignInAlt className="me-2" />
              Se connecter
            </a>
          </div>
        </div>
      </div>

      {/* Stats Section */}
      <div className="container py-5">
        <div className="row text-center">
          <div className="col-md-3 mb-4">
            <div className="bg-dark text-white rounded p-4 shadow-sm">
              <h2>500+</h2>
              <p>Produits médicaux</p>
            </div>
          </div>
          <div className="col-md-3 mb-4">
            <div className="bg-dark text-white rounded p-4 shadow-sm">
              <h2>50+</h2>
              <p>Fournisseurs</p>
            </div>
          </div>
          <div className="col-md-3 mb-4">
            <div className="bg-dark text-white rounded p-4 shadow-sm">
              <h2>1000+</h2>
              <p>Clients satisfaits</p>
            </div>
          </div>
          <div className="col-md-3 mb-4">
            <div className="bg-dark text-white rounded p-4 shadow-sm">
              <h2>24/7</h2>
              <p>Support client</p>
            </div>
          </div>
        </div>
      </div>

      {/* Optional Floating Assistant Icon */}
      <button className="btn btn-primary rounded-circle position-fixed bottom-0 end-0 m-4 shadow">
        <FaRobot size={24} />
      </button>
    </div>
  );
};

export default HomePage;
