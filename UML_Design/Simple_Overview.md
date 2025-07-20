# Medical Marketplace - Diagrammes Simplifiés

## Vue d'ensemble

Ce projet est un marketplace médical simple avec les fonctionnalités essentielles :

### Acteurs
- **Client** : Utilisateur qui achète des produits médicaux
- **Admin** : Administrateur qui gère les produits et commandes

### Fonctionnalités Principales

#### Pour les Clients :
1. **S'inscrire** - Créer un compte
2. **Se connecter** - Accéder à son compte
3. **Rechercher produits** - Trouver des produits médicaux
4. **Voir détails produit** - Consulter les informations
5. **Ajouter au panier** - Ajouter des produits
6. **Passer commande** - Finaliser l'achat

#### Pour les Admins :
1. **Gérer produits** - Ajouter/modifier/supprimer des produits
2. **Gérer commandes** - Suivre et traiter les commandes

### Structure de Base de Données

#### Tables principales :
- **users** : Utilisateurs (clients et admins)
- **products** : Produits médicaux
- **orders** : Commandes
- **order_items** : Détails des commandes

### Diagrammes UML

1. **Simple_Use_Case.puml** - Cas d'usage simplifiés
2. **Simple_Class_Diagram.puml** - Classes principales
3. **Simple_Database.puml** - Schéma de base de données
4. **Simple_Sequence.puml** - Processus d'achat

### Implémentation

#### Phase 1 : Base
- Authentification (inscription/connexion)
- Gestion des produits
- Interface de recherche

#### Phase 2 : Commerce
- Panier d'achat
- Processus de commande
- Gestion des stocks

#### Phase 3 : Administration
- Interface admin
- Gestion des commandes
- Tableau de bord

### Technologies
- **Backend** : Laravel (PHP)
- **Frontend** : Blade templates + CSS
- **Base de données** : MySQL/SQLite
- **Authentification** : Laravel Breeze

### Structure du Projet
```
Medical_MarketPlace/
├── app/
│   ├── Models/
│   │   ├── User.php
│   │   ├── Product.php
│   │   ├── Order.php
│   │   └── OrderItem.php
│   └── Http/Controllers/
│       ├── AuthController.php
│       ├── ProductController.php
│       └── OrderController.php
├── database/migrations/
│   ├── create_users_table.php
│   ├── create_products_table.php
│   ├── create_orders_table.php
│   └── create_order_items_table.php
└── resources/views/
    ├── auth/
    ├── products/
    ├── orders/
    └── admin/
```

### Prochaines Étapes
1. Créer les migrations de base de données
2. Implémenter les modèles
3. Créer les contrôleurs
4. Développer les vues
5. Tester les fonctionnalités 