# 🚀 Guide d'Accès à l'ERP - Medical Marketplace

## 📋 Prérequis
- Laravel 12.0 installé et configuré
- Base de données MySQL configurée
- Migrations et seeders exécutés avec succès

## 🔐 Accès à l'ERP

### 1. **Connexion à la Plateforme**
```
URL: http://localhost:8000 (ou votre URL de développement)
```

### 2. **Utilisateurs ERP Disponibles**

#### 👤 **Gestionnaire d'Entrepôt**
- **Email:** `warehouse@medical.com`
- **Mot de passe:** `password`
- **Rôle:** `warehouse_manager`
- **Accès:** Module Inventaire uniquement

#### 👤 **Comptable**
- **Email:** `accountant@medical.com`
- **Mot de passe:** `password`
- **Rôle:** `accountant`
- **Accès:** Module Comptabilité uniquement

#### 👤 **Acheteur**
- **Email:** `buyer@medical.com`
- **Mot de passe:** `password`
- **Rôle:** `buyer`
- **Accès:** Module Achats uniquement

#### 👤 **Responsable Commercial**
- **Email:** `sales@medical.com` (à créer)
- **Mot de passe:** `password`
- **Rôle:** `sales_manager`
- **Accès:** Module Ventes uniquement

#### 👤 **Administrateur**
- **Email:** `admin@medical.com`
- **Mot de passe:** `password`
- **Rôle:** `admin`
- **Accès:** Tous les modules ERP

### 3. **Étapes d'Accès**

#### Étape 1: Connexion
1. Allez sur la page d'accueil du marketplace
2. Cliquez sur "Connexion" en haut à droite
3. Utilisez les identifiants d'un utilisateur ERP ci-dessus

#### Étape 2: Accès à l'ERP
1. Une fois connecté, cliquez sur votre nom en haut à droite
2. Dans le menu déroulant, cliquez sur **"Accès ERP"**
3. Vous serez redirigé vers le tableau de bord ERP

#### Étape 3: Navigation dans l'ERP
- **Sidebar gauche:** Navigation entre les modules
- **Barre supérieure:** Informations utilisateur et statut
- **Contenu principal:** Tableau de bord avec statistiques

## 🎯 Modules ERP Disponibles

### 📦 **Module Inventaire** (Warehouse Manager)
- **Entrepôts:** Gestion des entrepôts et emplacements
- **Stock:** Suivi des niveaux de stock
- **Mouvements:** Historique des mouvements de stock

### 💰 **Module Comptabilité** (Accountant)
- **Plan Comptable:** Gestion du plan de comptes
- **Écritures:** Saisie des écritures comptables
- **Paiements:** Suivi des paiements

### 🛒 **Module Achats** (Buyer)
- **Fournisseurs:** Gestion des fournisseurs
- **Commandes:** Création et suivi des commandes

### 📈 **Module Ventes** (Sales Manager)
- **Clients:** Gestion de la clientèle
- **Devis:** Création de devis
- **Factures:** Émission de factures

## 🔧 Configuration Technique

### Routes ERP
```
/erp                    → Page d'accueil ERP
/erp/dashboard         → Tableau de bord principal
```

### Middleware de Sécurité
- **`erp.role`:** Vérifie les permissions d'accès aux modules
- **Authentification:** Requiert une connexion utilisateur
- **Vérification email:** Email doit être vérifié

### Base de Données
- **15 tables ERP** créées avec succès
- **Données initiales** chargées (entrepôts, plan comptable)
- **Relations** établies avec les tables marketplace existantes

## 🚨 Dépannage

### Problème: "Accès non autorisé à l'ERP"
**Solution:** Vérifiez que votre utilisateur a un rôle ERP valide

### Problème: Page blanche ou erreur 500
**Solution:** 
1. Vérifiez les logs Laravel: `storage/logs/laravel.log`
2. Exécutez: `php artisan config:clear`
3. Exécutez: `php artisan view:clear`

### Problème: Tables manquantes
**Solution:** 
1. Exécutez: `php artisan migrate:fresh --seed`
2. Vérifiez que toutes les migrations ERP sont présentes

## 📞 Support

Pour toute question ou problème:
1. Vérifiez ce guide en premier
2. Consultez le fichier `ERP_ARCHITECTURE.md` pour plus de détails
3. Vérifiez les logs d'erreur Laravel

---

**🎉 Votre ERP est maintenant opérationnel !** 