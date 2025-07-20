# Maquettes d'Interface Utilisateur - Medical MarketPlace

## 🎨 Design System

### Palette de Couleurs
```
Primaire : #2563eb (Bleu médical)
Secondaire : #059669 (Vert confiance)
Accent : #dc2626 (Rouge urgence)
Neutre : #6b7280 (Gris professionnel)
Succès : #10b981 (Vert validation)
Avertissement : #f59e0b (Orange attention)
Erreur : #ef4444 (Rouge erreur)
```

### Typographie
```
Titres : Inter, 700, 24-48px
Sous-titres : Inter, 600, 18-24px
Corps : Inter, 400, 16px
Petit texte : Inter, 400, 14px
```

### Composants
- **Boutons** : Border-radius 8px, Padding 12-16px
- **Cartes** : Ombre légère, Border-radius 12px
- **Formulaires** : Border 1px, Focus ring
- **Navigation** : Sticky header, Breadcrumbs

---

## 🏠 Page d'Accueil

```
┌─────────────────────────────────────────────────────────┐
│ [Logo] Medical MarketPlace    [🔍] [🛒] [👤] [📞]    │
├─────────────────────────────────────────────────────────┤
│                                                         │
│  🏥 Votre plateforme de matériel médical              │
│                                                         │
│  [Recherche rapide...] [🔍 Rechercher]                │
│                                                         │
│  📋 Catégories populaires                              │
│  ┌─────────┐ ┌─────────┐ ┌─────────┐ ┌─────────┐     │
│  │ 🩺      │ │ 💊      │ │ 🏥      │ │ 🧬      │     │
│  │Diagnostic│ │Médicaments│ │Équipements│ │Laboratoire│     │
│  └─────────┘ └─────────┘ └─────────┘ └─────────┘     │
│                                                         │
│  🔥 Produits en vedette                                │
│  ┌─────────┐ ┌─────────┐ ┌─────────┐ ┌─────────┐     │
│  │ [Image] │ │ [Image] │ │ [Image] │ │ [Image] │     │
│  │Stéthoscope│ │Tensiomètre│ │Thermomètre│ │Oxymètre   │     │
│  │ 89€     │ │ 45€     │ │ 25€     │ │ 35€     │     │
│  │ ⭐⭐⭐⭐⭐ │ │ ⭐⭐⭐⭐  │ │ ⭐⭐⭐⭐⭐ │ │ ⭐⭐⭐⭐  │     │
│  └─────────┘ └─────────┘ └─────────┘ └─────────┘     │
│                                                         │
│  📊 Pourquoi nous choisir ?                            │
│  ┌─────────┐ ┌─────────┐ ┌─────────┐                  │
│  │ 🚚      │ │ 🛡️      │ │ 💯      │                  │
│  │Livraison │ │Garantie  │ │Satisfaction│                  │
│  │rapide    │ │2 ans     │ │98%        │                  │
│  └─────────┘ └─────────┘ └─────────┘                  │
└─────────────────────────────────────────────────────────┘
```

---

## 🏥 Page Catalogue

```
┌─────────────────────────────────────────────────────────┐
│ [Logo] Medical MarketPlace    [🔍] [🛒] [👤] [📞]    │
├─────────────────────────────────────────────────────────┤
│                                                         │
│  🏥 Produits > Diagnostic > Stéthoscopes              │
│                                                         │
│  ┌─────────────────┐ ┌─────────────────────────────────┐ │
│  │ 🔍 Filtres      │ │ 📊 156 produits trouvés        │ │
│  │                 │ │                                 │ │
│  │ 💰 Prix         │ │ ┌─────────┐ ┌─────────┐ ┌─────┐ │ │
│  │ □ 0-50€         │ │ │ [Image] │ │ [Image] │ │ ... │ │ │
│  │ ☑ 50-100€       │ │ │Stéthoscope│ │Stéthoscope│ │     │ │ │
│  │ □ 100€+         │ │ │Littmann  │ │Welch Allyn│ │     │ │ │
│  │                 │ │ │ 89€      │ │ 95€      │ │     │ │ │
│  │ 🏷️ Marque        │ │ │ ⭐⭐⭐⭐⭐ │ │ ⭐⭐⭐⭐  │ │     │ │ │
│  │ ☑ Littmann      │ │ │ [Ajouter]│ │ [Ajouter]│ │     │ │ │
│  │ ☑ Welch Allyn   │ │ └─────────┘ └─────────┘ └─────┘ │ │
│  │ □ 3M            │ │                                 │ │
│  │                 │ │ ┌─────────┐ ┌─────────┐ ┌─────┐ │ │
│  │ 📦 Disponibilité│ │ │ [Image] │ │ [Image] │ │ ... │ │ │
│  │ ☑ En stock      │ │ │Stéthoscope│ │Stéthoscope│ │     │ │ │
│  │ □ Rupture       │ │ │Cardio III│ │Classic II│ │     │ │ │
│  │                 │ │ │ 120€     │ │ 75€      │ │     │ │ │
│  │ ⭐ Note          │ │ │ ⭐⭐⭐⭐⭐ │ │ ⭐⭐⭐⭐  │ │     │ │ │
│  │ ☑ 4+ étoiles    │ │ │ [Ajouter]│ │ [Ajouter]│ │     │ │ │
│  │ □ 3+ étoiles    │ │ └─────────┘ └─────────┘ └─────┘ │ │
│  │                 │ │                                 │ │
│  │ [Appliquer]     │ │ [1] [2] [3] ... [15] [Suivant] │ │
│  └─────────────────┘ └─────────────────────────────────┘ │
└─────────────────────────────────────────────────────────┘
```

---

## 🛒 Page Panier

```
┌─────────────────────────────────────────────────────────┐
│ [Logo] Medical MarketPlace    [🔍] [🛒] [👤] [📞]    │
├─────────────────────────────────────────────────────────┤
│                                                         │
│  🛒 Votre panier (3 articles)                          │
│                                                         │
│  ┌─────────────────────────────────────────────────────┐ │
│  │ ┌─────────┐ ┌─────────────────────────────────────┐ │ │
│  │ │ [Image] │ │ Stéthoscope Littmann Classic III   │ │ │
│  │ │         │ │ Référence: ST-001                   │ │ │
│  │ │         │ │ Prix unitaire: 89€                  │ │ │
│  │ │         │ │ [1] [2] [3] [4] [5] [+/-] [🗑️]    │ │ │
│  │ │         │ │ Sous-total: 445€                    │ │ │
│  │ └─────────┘ └─────────────────────────────────────┘ │ │
│  │                                                     │ │
│  │ ┌─────────┐ ┌─────────────────────────────────────┐ │ │
│  │ │ [Image] │ │ Tensiomètre automatique Omron      │ │ │
│  │ │         │ │ Référence: TEN-002                  │ │ │
│  │ │         │ │ Prix unitaire: 45€                  │ │ │
│  │ │         │ │ [1] [2] [3] [4] [5] [+/-] [🗑️]    │ │ │
│  │ │         │ │ Sous-total: 135€                    │ │ │
│  │ └─────────┘ └─────────────────────────────────────┘ │ │
│  │                                                     │ │
│  │ ┌─────────┐ ┌─────────────────────────────────────┐ │ │
│  │ │ [Image] │ │ Thermomètre infrarouge Braun       │ │ │
│  │ │         │ │ Référence: THE-003                  │ │ │
│  │ │         │ │ Prix unitaire: 25€                  │ │ │
│  │ │         │ │ [1] [2] [3] [4] [5] [+/-] [🗑️]    │ │ │
│  │ │         │ │ Sous-total: 75€                     │ │ │
│  │ └─────────┘ └─────────────────────────────────────┘ │ │
│  └─────────────────────────────────────────────────────┘ │
│                                                         │
│  ┌─────────────────┐ ┌─────────────────────────────────┐ │
│  │ 📋 Résumé       │ │ 💳 Passer la commande          │ │ │
│  │                 │ │                                 │ │ │
│  │ Sous-total:     │ │ [Continuer mes achats]         │ │ │
│  │ 655€            │ │                                 │ │ │
│  │                 │ │ [Vider le panier]              │ │ │
│  │ Livraison:      │ │                                 │ │ │
│  │ 9.90€           │ │ [Appliquer un code promo]      │ │ │
│  │                 │ │                                 │ │ │
│  │ Taxes:          │ │ [💳 PASSER LA COMMANDE]        │ │ │
│  │ 131€            │ │                                 │ │ │
│  │                 │ │ 🔒 Paiement sécurisé SSL       │ │ │
│  │ Total:          │ │ 💳 Visa, Mastercard, PayPal    │ │ │
│  │ 795.90€         │ │                                 │ │ │
│  └─────────────────┘ └─────────────────────────────────┘ │
└─────────────────────────────────────────────────────────┘
```

---

## 💳 Page Checkout

```
┌─────────────────────────────────────────────────────────┐
│ [Logo] Medical MarketPlace    [🔍] [🛒] [👤] [📞]    │
├─────────────────────────────────────────────────────────┤
│                                                         │
│  💳 Finaliser votre commande                           │
│                                                         │
│  ┌─────────────────┐ ┌─────────────────────────────────┐ │
│  │ 👤 Informations │ │ 📦 Résumé de la commande       │ │ │
│  │    personnelles │ │                                 │ │ │
│  │                 │ │ ┌─────────────────────────────┐ │ │ │
│  │ Prénom: [_____] │ │ │ Stéthoscope Littmann       │ │ │ │
│  │ Nom: [_______]  │ │ │ Quantité: 5                │ │ │ │
│  │ Email: [______] │ │ │ Prix: 445€                 │ │ │ │
│  │ Tél: [________] │ │ └─────────────────────────────┘ │ │ │
│  │                 │ │ ┌─────────────────────────────┐ │ │ │
│  │ 📍 Adresse de   │ │ │ Tensiomètre Omron          │ │ │ │
│  │    livraison    │ │ │ Quantité: 3                │ │ │ │
│  │                 │ │ │ Prix: 135€                 │ │ │ │
│  │ Rue: [________] │ │ └─────────────────────────────┘ │ │ │ │
│  │ Ville: [______] │ │ ┌─────────────────────────────┐ │ │ │ │
│  │ CP: [_______]   │ │ │ Thermomètre Braun          │ │ │ │
│  │ Pays: [France]  │ │ │ Quantité: 3                │ │ │ │
│  │                 │ │ │ Prix: 75€                  │ │ │ │
│  │ 🚚 Mode de      │ │ └─────────────────────────────┘ │ │ │ │
│  │    livraison    │ │                                 │ │ │ │
│  │                 │ │ Sous-total: 655€               │ │ │ │
│  │ ☑ Standard      │ │ Livraison: 9.90€              │ │ │ │
│  │   (3-5 jours)   │ │ Taxes: 131€                   │ │ │ │
│  │ □ Express       │ │                                 │ │ │ │
│  │   (1-2 jours)   │ │ Total: 795.90€                │ │ │ │
│  │ □ Point relais   │ │                                 │ │ │ │
│  │                 │ │ 💳 Mode de paiement            │ │ │ │
│  │ 💳 Paiement     │ │                                 │ │ │ │
│  │                 │ │ ☑ Carte bancaire              │ │ │ │
│  │ ☑ Carte bancaire│ │ □ PayPal                      │ │ │ │
│  │ □ PayPal        │ │ □ Virement bancaire           │ │ │ │
│  │ □ Virement      │ │                                 │ │ │ │
│  │                 │ │ Numéro: [________________]     │ │ │ │
│  │ Numéro: [____]  │ │ Expiration: [MM/YY]           │ │ │ │
│  │ Exp: [MM/YY]    │ │ CVV: [___]                    │ │ │ │
│  │ CVV: [___]      │ │                                 │ │ │ │
│  │                 │ │ [CONFIRMER LA COMMANDE]        │ │ │ │
│  │ [CONFIRMER]     │ │                                 │ │ │ │
│  └─────────────────┘ └─────────────────────────────────┘ │
└─────────────────────────────────────────────────────────┘
```

---

## 👤 Page Profil Utilisateur

```
┌─────────────────────────────────────────────────────────┐
│ [Logo] Medical MarketPlace    [🔍] [🛒] [👤] [📞]    │
├─────────────────────────────────────────────────────────┤
│                                                         │
│  👤 Mon compte > Profil                                 │
│                                                         │
│  ┌─────────────────┐ ┌─────────────────────────────────┐ │
│  │ 📋 Menu         │ │ 👤 Informations personnelles   │ │ │
│  │                 │ │                                 │ │ │
│  │ ☑ Profil        │ │ Prénom: [Jean]                 │ │ │
│  │ □ Commandes     │ │ Nom: [Dupont]                  │ │ │
│  │ □ Adresses      │ │ Email: [jean.dupont@email.com] │ │ │
│  │ □ Favoris       │ │ Téléphone: [01 23 45 67 89]   │ │ │
│  │ □ Avis          │ │                                 │ │ │
│  │ □ Sécurité      │ │ Date de naissance: [15/03/1985]│ │ │
│  │ □ Notifications │ │                                 │ │ │
│  │                 │ │ [Sauvegarder les modifications]│ │ │
│  │                 │ │                                 │ │ │
│  │                 │ │ 📍 Adresses de livraison       │ │ │
│  │                 │ │                                 │ │ │
│  │                 │ │ 🏠 Adresse principale           │ │ │
│  │                 │ │ Rue: [123 Rue de la Paix]      │ │ │
│  │                 │ │ Ville: [Paris]                 │ │ │
│  │                 │ │ Code postal: [75001]           │ │ │
│  │                 │ │ Pays: [France]                 │ │ │
│  │                 │ │                                 │ │ │
│  │                 │ │ 🏢 Adresse professionnelle     │ │ │
│  │                 │ │ Rue: [456 Avenue des Champs]   │ │ │
│  │                 │ │ Ville: [Paris]                 │ │ │
│  │                 │ │ Code postal: [75008]           │ │ │
│  │                 │ │ Pays: [France]                 │ │ │
│  │                 │ │                                 │ │ │
│  │                 │ │ [Ajouter une adresse]          │ │ │
│  └─────────────────┘ └─────────────────────────────────┘ │
└─────────────────────────────────────────────────────────┘
```

---

## ⚙️ Interface d'Administration

```
┌─────────────────────────────────────────────────────────┐
│ [Logo] Admin Dashboard    [🔔] [👤 Admin] [🚪 Déconnexion] │
├─────────────────────────────────────────────────────────┤
│                                                         │
│  📊 Tableau de bord                                    │
│                                                         │
│  ┌─────────┐ ┌─────────┐ ┌─────────┐ ┌─────────┐     │
│  │ 📈      │ │ 🛒      │ │ 👥      │ │ ⚠️      │     │
│  │ Ventes  │ │Commandes│ │Clients  │ │Stock    │     │
│  │ 12,450€ │ │ 45      │ │ 1,234   │ │ 23      │     │
│  │ +15%    │ │ +8      │ │ +12     │ │ Alertes │     │
│  └─────────┘ └─────────┘ └─────────┘ └─────────┘     │
│                                                         │
│  ┌─────────────────────────────────────────────────────┐ │
│  │ 📋 Commandes récentes                               │ │
│  │ ┌─────┐ ┌─────────────────┐ ┌─────────┐ ┌──────┐ │ │
│  │ │ #123│ │ Jean Dupont     │ │ 795.90€ │ │ ✅   │ │ │
│  │ │ #124│ │ Marie Martin    │ │ 245.50€ │ │ ⏳   │ │ │
│  │ │ #125│ │ Pierre Durand   │ │ 1,250€  │ │ ⏳   │ │ │
│  │ └─────┘ └─────────────────┘ └─────────┘ └──────┘ │ │
│  └─────────────────────────────────────────────────────┘ │
│                                                         │
│  ┌─────────────────┐ ┌─────────────────────────────────┐ │
│  │ 🏥 Produits     │ │ 📊 Graphiques de vente         │ │ │
│  │                 │ │                                 │ │ │
│  │ [Ajouter]       │ │ [Graphique des ventes]         │ │ │
│  │ [Modifier]      │ │                                 │ │ │
│  │ [Supprimer]     │ │ [Graphique des catégories]     │ │ │
│  │                 │ │                                 │ │ │
│  │ 🔍 Recherche    │ │ [Graphique des clients]        │ │ │
│  │ [___________]   │ │                                 │ │ │
│  │                 │ │                                 │ │ │
│  │ 📋 Catégories   │ │                                 │ │ │
│  │ ☑ Diagnostic    │ │                                 │ │ │
│  │ ☑ Médicaments   │ │                                 │ │ │
│  │ ☑ Équipements   │ │                                 │ │ │
│  │ ☑ Laboratoire   │ │                                 │ │ │
│  └─────────────────┘ └─────────────────────────────────┘ │
└─────────────────────────────────────────────────────────┘
```

---

## 📱 Interface Mobile

### Navigation Mobile
```
┌─────────────────┐
│ 🏠 [🔍] [🛒] 👤 │
├─────────────────┤
│                 │
│  🏥 Produits    │
│  📋 Catégories  │
│  🔥 Promotions  │
│  📞 Contact     │
│                 │
│  [Menu burger]  │
└─────────────────┘
```

### Page Produit Mobile
```
┌─────────────────┐
│ ← Stéthoscope   │
├─────────────────┤
│                 │
│  [Image]        │
│                 │
│  Stéthoscope    │
│  Littmann       │
│  89€            │
│  ⭐⭐⭐⭐⭐      │
│                 │
│  [Ajouter]      │
│                 │
│  Description    │
│  [Texte...]     │
│                 │
│  Caractéristiques│
│  [Liste...]     │
│                 │
│  Avis clients   │
│  [Liste...]     │
└─────────────────┘
```

---

## 🎨 Composants UI

### Boutons
```
[Primaire] [Secondaire] [Danger] [Succès]
[Large] [Normal] [Petit]
[Arrondi] [Carré]
```

### Formulaires
```
┌─────────────────┐
│ Label           │
│ [Input field]   │
│ Message d'aide  │
└─────────────────┘
```

### Cartes
```
┌─────────────────┐
│ [Image]         │
│ Titre           │
│ Description     │
│ Prix            │
│ [Action]        │
└─────────────────┘
```

### Modales
```
┌─────────────────┐
│ [X] Titre       │
│                 │
│ Contenu...      │
│                 │
│ [Action] [Action]│
└─────────────────┘
```

---

*Maquettes créées le : [Date]*
*Version : 1.0 - Interface utilisateur* 