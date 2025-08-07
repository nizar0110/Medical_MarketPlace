# Guide d'Implémentation ERP - Medical Marketplace

## 🚀 Installation et Configuration

### 1. Exécution des migrations

```bash
# Exécuter toutes les migrations ERP
php artisan migrate

# Vérifier les migrations
php artisan migrate:status
```

### 2. Exécution des seeders

```bash
# Exécuter les seeders ERP
php artisan db:seed --class=ERPInventorySeeder
php artisan db:seed --class=ERPAccountingSeeder

# Ou exécuter tous les seeders
php artisan db:seed
```

### 3. Configuration des variables d'environnement

Ajoutez ces variables à votre fichier `.env` :

```env
# ERP Modules
ERP_INVENTORY_ENABLED=true
ERP_SALES_ENABLED=true
ERP_PURCHASES_ENABLED=true
ERP_ACCOUNTING_ENABLED=true

# ERP Settings
ERP_COMPANY_NAME="Medical Marketplace"
ERP_COMPANY_ADDRESS="123 Rue de la Santé, 75001 Paris"
ERP_COMPANY_PHONE="+33 1 23 45 67 89"
ERP_COMPANY_EMAIL="contact@medicalmarketplace.com"
ERP_DEFAULT_TAX_RATE=20.0
ERP_CURRENCY=EUR
ERP_FISCAL_YEAR_START=01-01
ERP_AUTO_JOURNAL_ENTRIES=true
ERP_STOCK_VALUATION=average
ERP_DEFAULT_PAYMENT_TERMS=30
```

## 📊 Structure de la Base de Données

### Module Inventory
- **erp_inventory_warehouses** : Entrepôts
- **erp_inventory_locations** : Emplacements dans les entrepôts
- **erp_inventory_stock_movements** : Mouvements de stock
- **erp_inventory_stock_levels** : Niveaux de stock par entrepôt

### Module Sales
- **erp_sales_customers** : Clients ERP
- **erp_sales_quotes** : Devis
- **erp_sales_quote_items** : Éléments de devis
- **erp_sales_invoices** : Factures de vente

### Module Purchases
- **erp_purchases_suppliers** : Fournisseurs
- **erp_purchases_purchase_orders** : Commandes d'achat
- **erp_purchases_purchase_order_items** : Éléments de commande

### Module Accounting
- **erp_accounting_chart_of_accounts** : Plan comptable
- **erp_accounting_journal_entries** : Écritures comptables
- **erp_accounting_journal_entry_lines** : Lignes d'écritures
- **erp_accounting_payments** : Paiements

## 👥 Rôles Utilisateur

### Rôles existants étendus :
- **admin** : Accès complet à tous les modules
- **seller** : Gestion des produits et ventes
- **client** : Achat de produits

### Nouveaux rôles ERP :
- **warehouse_manager** : Gestion des entrepôts et stocks
- **accountant** : Gestion comptable
- **buyer** : Gestion des achats et fournisseurs
- **sales_manager** : Gestion commerciale avancée

## 🔄 Workflows Intégrés

### Workflow de Vente
1. **Commande** (table `orders` existante)
2. **Facture** (table `erp_sales_invoices`)
3. **Paiement** (table `erp_accounting_payments`)
4. **Écriture comptable** (table `erp_accounting_journal_entries`)
5. **Mouvement de stock** (table `erp_inventory_stock_movements`)

### Workflow d'Achat
1. **Commande d'achat** (table `erp_purchases_purchase_orders`)
2. **Réception** (mise à jour des stocks)
3. **Facture fournisseur** (à implémenter)
4. **Paiement fournisseur** (table `erp_accounting_payments`)
5. **Écriture comptable** (table `erp_accounting_journal_entries`)

## 📈 Prochaines Étapes de Développement

### Phase 1 : Modèles et Relations
```bash
# Créer les modèles Eloquent
php artisan make:model Modules/Inventory/Warehouse
php artisan make:model Modules/Inventory/Location
php artisan make:model Modules/Inventory/StockMovement
php artisan make:model Modules/Inventory/StockLevel

php artisan make:model Modules/Sales/Customer
php artisan make:model Modules/Sales/Quote
php artisan make:model Modules/Sales/Invoice

php artisan make:model Modules/Purchases/Supplier
php artisan make:model Modules/Purchases/PurchaseOrder

php artisan make:model Modules/Accounting/ChartOfAccount
php artisan make:model Modules/Accounting/JournalEntry
php artisan make:model Modules/Accounting/Payment
```

### Phase 2 : Contrôleurs et Services
```bash
# Créer les contrôleurs
php artisan make:controller Modules/Inventory/WarehouseController --resource
php artisan make:controller Modules/Inventory/StockController --resource
php artisan make:controller Modules/Sales/CustomerController --resource
php artisan make:controller Modules/Sales/InvoiceController --resource
php artisan make:controller Modules/Purchases/SupplierController --resource
php artisan make:controller Modules/Accounting/JournalEntryController --resource
```

### Phase 3 : Middleware et Permissions
```bash
# Créer le middleware de permissions ERP
php artisan make:middleware ERPPermissionMiddleware
```

### Phase 4 : Interfaces Utilisateur
- Dashboards par module
- Formulaires de saisie
- Rapports et analyses
- Notifications et alertes

## 🧪 Tests

### Tests Unitaires
```bash
# Créer les tests pour chaque module
php artisan make:test Modules/Inventory/WarehouseTest
php artisan make:test Modules/Sales/CustomerTest
php artisan make:test Modules/Purchases/SupplierTest
php artisan make:test Modules/Accounting/JournalEntryTest
```

### Tests d'Intégration
```bash
# Tests des workflows complets
php artisan make:test ERPWorkflowTest
```

## 📋 Checklist d'Implémentation

### ✅ Phase 1 - Infrastructure
- [x] Migrations créées
- [x] Seeders créés
- [x] Configuration ERP
- [x] Documentation

### 🔄 Phase 2 - Modèles et Relations
- [ ] Modèles Eloquent
- [ ] Relations entre modèles
- [ ] Scopes et accesseurs
- [ ] Validation des données

### 🔄 Phase 3 - Contrôleurs et Services
- [ ] Contrôleurs CRUD
- [ ] Services métier
- [ ] Validation des formulaires
- [ ] Gestion des erreurs

### 🔄 Phase 4 - Interface Utilisateur
- [ ] Dashboards
- [ ] Formulaires
- [ ] Rapports
- [ ] Notifications

### 🔄 Phase 5 - Workflows Automatiques
- [ ] Écritures comptables automatiques
- [ ] Mise à jour des stocks
- [ ] Génération de factures
- [ ] Alertes et notifications

### 🔄 Phase 6 - Tests et Validation
- [ ] Tests unitaires
- [ ] Tests d'intégration
- [ ] Tests de performance
- [ ] Validation des workflows

## 🚨 Points d'Attention

### Sécurité
- Vérifier les permissions pour chaque action
- Valider toutes les entrées utilisateur
- Implémenter un audit trail complet

### Performance
- Indexer les colonnes fréquemment utilisées
- Optimiser les requêtes complexes
- Mettre en cache les données statiques

### Conformité
- Respecter les normes comptables
- Traçabilité complète des mouvements
- Sauvegarde régulière des données

## 📞 Support

Pour toute question ou problème :
1. Consultez la documentation dans `ERP_ARCHITECTURE.md`
2. Vérifiez les logs Laravel
3. Testez les workflows étape par étape
4. Contactez l'équipe de développement

---

**Note** : Cette architecture ERP est conçue pour être évolutive et modulaire. Chaque module peut être développé et testé indépendamment, tout en maintenant l'intégration avec le système existant. 