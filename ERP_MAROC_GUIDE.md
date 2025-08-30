# 🇲🇦 Guide ERP Maroc - Medical Market SARL

## 📋 Vue d'ensemble

L'ERP de Medical Market SARL est entièrement adapté au contexte marocain avec :
- **Devise** : Dirham marocain (DH)
- **TVA** : 20% (taux marocain)
- **Langue** : Français (langue officielle)
- **Fuseau horaire** : Africa/Casablanca
- **Conformité** : Standards marocains

## 🏢 Informations de l'entreprise

```
Medical Market SARL
123 Rue de la Santé, Quartier Maarif
Casablanca 20000, Maroc

📞 +212 6 12 345 678
📧 contact@medicalmarket.ma
🌐 www.medicalmarket.ma

RC: 123456 | ICE: 123456789 | CNSS: 123456789
TVA: MA123456789
```

## 💰 Configuration monétaire

### Devise
- **Symbole** : DH (Dirham)
- **Code** : MAD
- **Format** : 1 234,56 DH
- **Séparateur décimal** : Virgule (,)
- **Séparateur de milliers** : Espace ( )

### TVA
- **Taux standard** : 20%
- **Calcul automatique** : Activé
- **Numéro de TVA** : MA123456789

## 📊 Modules ERP disponibles

### 1. 📦 Module Inventaire
- **Gestion des entrepôts** : Casablanca (principal) et Rabat (régional)
- **Emplacements** : Zones A, B, C, D avec allées et étagères
- **Mouvements de stock** : Entrées, sorties, transferts, ajustements
- **Rôle** : `warehouse_manager`

### 2. 🛒 Module Achats
- **Fournisseurs marocains** : PharmaTech, MediSupply, EquipMedical
- **Commandes d'achat** : Gestion des PO avec conditions de paiement
- **Réception** : Traitement des livraisons
- **Rôle** : `buyer`

### 3. 💰 Module Ventes
- **Clients marocains** : Cliniques, hôpitaux, centres médicaux
- **Devis** : Numérotation automatique DEV-2025-001
- **Factures** : Numérotation automatique FACT-2025-001
- **Rôle** : `sales_manager`

## 🔧 Utilisation des helpers marocains

### Formatage des montants
```php
use App\Helpers\MarocHelper;

// Formater un montant en DH
$montant = MarocHelper::formatCurrency(15000.50);
// Résultat : "15 000,50 DH"
```

### Calcul de la TVA
```php
$tva = MarocHelper::calculateTVA(1000.00, 20.0);
// Résultat : ['ht' => 1000.00, 'tva_rate' => 20.0, 'tva_amount' => 200.00, 'ttc' => 1200.00]
```

### Formatage des dates
```php
$date = MarocHelper::formatDate('2025-01-15');
// Résultat : "15/01/2025"
```

### Formatage des numéros de téléphone
```php
$phone = MarocHelper::formatPhone('0612345678');
// Résultat : "+212 6 12 34 56 78"
```

## 📍 Régions et villes supportées

### Casablanca-Settat
- Casablanca (20000)
- Mohammedia
- El Jadida
- Settat

### Rabat-Salé-Kénitra
- Rabat (10000)
- Salé
- Kénitra
- Témara

### Marrakech-Safi
- Marrakech (40000)
- Safi
- Essaouira
- El Kelaa des Sraghna

### Fès-Meknès
- Fès (30000)
- Meknès
- Ifrane
- Taza

### Tanger-Tétouan-Al Hoceïma
- Tanger (90000)
- Tétouan
- Al Hoceïma
- Larache

## 🏦 Banques marocaines supportées

- **BMCE** : Banque Marocaine du Commerce Extérieur
- **BMCI** : Banque Marocaine pour le Commerce et l'Industrie
- **SGMB** : Société Générale Marocaine de Banques
- **CFG** : Crédit du Maroc
- **Attijariwafa Bank**

## ⏰ Horaires d'ouverture

```
Lundi - Vendredi : 8h00 - 18h00
Samedi : 9h00 - 16h00
Dimanche : Fermé
Fuseau horaire : Africa/Casablanca
```

## 📋 Conditions de paiement

### Standard
- **Paiement à 30 jours** (par défaut)
- **Options disponibles** : 0, 15, 30, 45, 60, 90 jours

### Facturation
- **Numérotation automatique** : FACT-2025-001
- **TVA incluse** : 20%
- **Échéance** : 30 jours après émission

## 🚀 Démarrage rapide

### 1. Accéder à l'ERP
```
URL : /erp
Rôle requis : warehouse_manager, buyer, sales_manager, ou admin
```

### 2. Vérifier la configuration
```
Config : config/maroc.php
ERP : config/erp.php
```

### 3. Exécuter les seeders
```bash
php artisan db:seed --class=ERPMarocSeeder
```

## 🔍 Dépannage

### Problème : Devise affichée en EUR au lieu de DH
**Solution** : Vérifier `config/erp.php` → `currency => 'MAD'`

### Problème : TVA incorrecte
**Solution** : Vérifier `config/erp.php` → `tax_rate => 20.0`

### Problème : Adresses non marocaines
**Solution** : Exécuter `php artisan db:seed --class=ERPInventorySeeder`

## 📞 Support technique

- **Email** : support@medicalmarket.ma
- **Téléphone** : +212 6 12 345 678
- **Horaires** : Lun-Ven 8h-18h, Sam 9h-16h

## 📚 Ressources additionnelles

- **Documentation Laravel** : https://laravel.com/docs
- **Standards marocains** : Office Marocain de Normalisation
- **Réglementation fiscale** : Direction Générale des Impôts

---

**Version** : 1.0  
**Dernière mise à jour** : Janvier 2025  
**Conformité** : Standards marocains ✅
