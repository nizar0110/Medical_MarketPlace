# 🧪 Test de Sélection de Fournisseur dans les Commandes

## ✅ **Problème résolu**

### **Problème initial :**
- ❌ **Impossible de sélectionner un fournisseur** dans le formulaire de création de commande
- ❌ **Select vide** sans options de fournisseurs
- ❌ **Formulaire non fonctionnel** pour créer des commandes

### **Solution implémentée :**
- ✅ **Contrôleur mis à jour** pour passer les fournisseurs à la vue
- ✅ **Select peuplé** avec tous les fournisseurs actifs
- ✅ **Formulaire fonctionnel** avec validation et soumission
- ✅ **JavaScript dynamique** pour gérer les articles

## 🎯 **Fonctionnalités ajoutées**

### **1. Contrôleur - `PurchasesController.php`**
```php
// Méthode purchaseOrders() mise à jour
$suppliers = DB::table('erp_purchases_suppliers')
    ->where('status', 'active')
    ->orderBy('company_name')
    ->get(['id', 'company_name', 'contact_name']);

// Nouvelle méthode storePurchaseOrder()
public function storePurchaseOrder(Request $request)
{
    // Validation complète
    // Génération automatique de référence
    // Calcul du montant total
    // Création de la commande et des lignes
}
```

### **2. Route - `web.php`**
```php
Route::post('/purchase-orders', [PurchasesController::class, 'storePurchaseOrder'])
    ->name('purchase_orders.store');
```

### **3. Vue - `purchase_orders.blade.php`**
```html
<!-- Select des fournisseurs -->
<select class="form-select" id="supplier_id" name="supplier_id" required>
    <option value="">Sélectionner un fournisseur...</option>
    @foreach($suppliers as $supplier)
        <option value="{{ $supplier->id }}">
            {{ $supplier->company_name }}
            @if($supplier->contact_name)
                - {{ $supplier->contact_name }}
            @endif
        </option>
    @endforeach
</select>

<!-- Formulaire complet avec articles dynamiques -->
<form method="POST" action="{{ route('erp.purchases.purchase_orders.store') }}">
    @csrf
    <!-- Champs de base -->
    <!-- Articles dynamiques -->
    <!-- JavaScript pour calculs -->
</form>
```

## 🎯 **Test de la fonctionnalité**

### **Étape 1 : Vérification des fournisseurs**
```bash
# 1. Connectez-vous avec un compte ERP (rôle achats)
# 2. Allez sur : http://127.0.0.1:8000/erp/purchases/suppliers
# 3. Vérifiez qu'il y a des fournisseurs créés
# 4. Notez les noms des fournisseurs disponibles
```

### **Étape 2 : Test de la page commandes**
```bash
# 1. Allez sur : http://127.0.0.1:8000/erp/purchases/purchase-orders
# 2. Vérifiez que la page se charge sans erreur
# 3. Cliquez sur "Nouvelle Commande"
# 4. Vérifiez que le modal s'ouvre
```

### **Étape 3 : Test du select fournisseur**
```bash
# 1. Dans le modal, cliquez sur le select "Fournisseur"
# 2. Vérifiez que la liste des fournisseurs s'affiche
# 3. Vérifiez le format : "Nom Société - Nom Contact"
# 4. Sélectionnez un fournisseur
```

### **Étape 4 : Test de création de commande**
```bash
# 1. Remplissez le formulaire :
#    - Fournisseur : Sélectionnez un fournisseur
#    - Référence : Laissez vide (auto-généré)
#    - Notes : "Commande de test"
#    - Article 1 :
#      * Produit : "Paracétamol 500mg"
#      * Quantité : 100
#      * Prix unitaire : 2.50
#    - Vérifiez que le total se calcule automatiquement

# 2. Cliquez sur "Créer la Commande"
# 3. Vérifiez la redirection et le message de succès
```

### **Étape 5 : Vérification de la commande**
```bash
# 1. Vérifiez que la nouvelle commande apparaît dans la liste
# 2. Vérifiez que la référence est générée (PO-001, PO-002, etc.)
# 3. Vérifiez que le fournisseur est affiché correctement
# 4. Vérifiez que le montant total est correct
# 5. Cliquez sur "Voir" pour vérifier les détails
```

## 📋 **Fonctionnalités du formulaire**

### **Champs de base :**
- ✅ **Référence** (optionnel, auto-généré si vide)
- ✅ **Fournisseur** (obligatoire, select avec tous les fournisseurs actifs)
- ✅ **Notes** (optionnel)

### **Articles dynamiques :**
- ✅ **Nom du produit** (obligatoire)
- ✅ **Quantité** (obligatoire, minimum 1)
- ✅ **Prix unitaire** (obligatoire, en DH)
- ✅ **Total** (calculé automatiquement)
- ✅ **Bouton supprimer** (pour chaque article)
- ✅ **Bouton ajouter** (pour ajouter de nouveaux articles)

### **Calculs automatiques :**
- ✅ **Total par article** = Quantité × Prix unitaire
- ✅ **Total de la commande** = Somme de tous les articles
- ✅ **Mise à jour en temps réel** lors de la saisie

## 🔧 **Validation côté serveur**

```php
$request->validate([
    'supplier_id' => 'required|exists:erp_purchases_suppliers,id',
    'reference' => 'nullable|string|max:100',
    'notes' => 'nullable|string|max:500',
    'items' => 'required|array|min:1',
    'items.*.product_name' => 'required|string|max:255',
    'items.*.quantity' => 'required|integer|min:1',
    'items.*.unit_price' => 'required|numeric|min:0',
]);
```

## 🗄️ **Base de données**

### **Table :** `erp_purchases_purchase_orders`
```sql
- id (clé primaire)
- reference (auto-généré PO-001, PO-002, etc.)
- supplier_id (clé étrangère vers erp_purchases_suppliers)
- order_date
- expected_delivery_date
- total_amount
- status (pending, approved, received, cancelled)
- notes
- created_at
- updated_at
```

### **Table :** `erp_purchases_purchase_order_items`
```sql
- id (clé primaire)
- purchase_order_id (clé étrangère)
- product_name
- quantity
- unit_price
- total_price
- created_at
- updated_at
```

## 🎨 **Interface utilisateur**

### **Modal de création :**
- ✅ Design Bootstrap responsive
- ✅ Select avec tous les fournisseurs actifs
- ✅ Articles dynamiques avec calculs automatiques
- ✅ Validation HTML5
- ✅ Messages de feedback

### **JavaScript dynamique :**
- ✅ Ajout/suppression d'articles
- ✅ Calcul automatique des totaux
- ✅ Validation côté client
- ✅ Interface intuitive

## 🚀 **Instructions de test**

```bash
# 1. Démarrer le serveur
php artisan serve

# 2. Se connecter avec un compte ERP (rôle achats)
# 3. Créer quelques fournisseurs si nécessaire
# 4. Aller sur /erp/purchases/purchase-orders
# 5. Tester la création d'une commande
# 6. Vérifier l'affichage dans la liste
```

## ✅ **Résultat attendu**

- ✅ **Select fournisseur** affiche tous les fournisseurs actifs
- ✅ **Format d'affichage** : "Nom Société - Nom Contact"
- ✅ **Sélection fonctionnelle** du fournisseur
- ✅ **Création de commande** avec validation complète
- ✅ **Calculs automatiques** des totaux
- ✅ **Articles dynamiques** avec ajout/suppression
- ✅ **Messages de succès** et redirection
- ✅ **Affichage correct** dans la liste des commandes

---

**Statut :** ✅ Problème résolu - Sélection de fournisseur fonctionnelle  
**Date :** 30 Août 2025
