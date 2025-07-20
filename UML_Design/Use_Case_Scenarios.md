# Scénarios de Cas d'Utilisation - Medical MarketPlace

## 🎯 Vue d'ensemble

Ce document détaille les scénarios principaux pour chaque cas d'utilisation identifié dans le diagramme UML.

---

## 👤 Cas d'Usage : Visiteur

### UC1 - Consulter les produits

**Acteur principal :** Visiteur  
**Préconditions :** Aucune  
**Scénario principal :**
1. Le visiteur accède à la page d'accueil
2. Le système affiche les catégories principales
3. Le visiteur clique sur une catégorie
4. Le système affiche la liste des produits
5. Le visiteur peut parcourir les pages

**Scénarios alternatifs :**
- Aucun produit disponible → Message "Aucun produit trouvé"
- Erreur de chargement → Message d'erreur avec bouton de retry

### UC2 - Rechercher des produits

**Acteur principal :** Visiteur  
**Préconditions :** Aucune  
**Scénario principal :**
1. Le visiteur saisit un terme de recherche
2. Le système propose des suggestions
3. Le visiteur valide sa recherche
4. Le système affiche les résultats
5. Le visiteur peut appliquer des filtres

**Scénarios alternatifs :**
- Aucun résultat → Suggestion de termes similaires
- Recherche trop générale → Proposition de catégories

### UC3 - Voir les détails d'un produit

**Acteur principal :** Visiteur  
**Préconditions :** Produit sélectionné  
**Scénario principal :**
1. Le visiteur clique sur un produit
2. Le système affiche la fiche détaillée
3. Le visiteur peut voir les photos, prix, description
4. Le visiteur peut consulter les avis clients
5. Le visiteur peut voir les produits similaires

**Scénarios alternatifs :**
- Produit indisponible → Affichage du statut "Rupture"
- Produit en promotion → Affichage du prix barré et prix promo

### UC4 - S'inscrire

**Acteur principal :** Visiteur  
**Préconditions :** Aucune  
**Scénario principal :**
1. Le visiteur clique sur "S'inscrire"
2. Le système affiche le formulaire d'inscription
3. Le visiteur remplit ses informations
4. Le système valide les données
5. Le système envoie un email de confirmation
6. Le visiteur confirme son email
7. Le compte est activé

**Scénarios alternatifs :**
- Email déjà utilisé → Message d'erreur
- Données invalides → Affichage des erreurs
- Email non confirmé → Relance automatique

---

## 🛒 Cas d'Usage : Client

### UC9 - Ajouter au panier

**Acteur principal :** Client  
**Préconditions :** Client connecté, produit sélectionné  
**Scénario principal :**
1. Le client sélectionne un produit
2. Le client choisit la quantité
3. Le client clique sur "Ajouter au panier"
4. Le système vérifie la disponibilité
5. Le système ajoute le produit au panier
6. Le système affiche une confirmation

**Scénarios alternatifs :**
- Stock insuffisant → Message d'alerte
- Produit déjà dans le panier → Mise à jour de la quantité
- Produit indisponible → Message d'erreur

### UC10 - Gérer le panier

**Acteur principal :** Client  
**Préconditions :** Client connecté, panier non vide  
**Scénario principal :**
1. Le client accède à son panier
2. Le système affiche la liste des articles
3. Le client peut modifier les quantités
4. Le client peut supprimer des articles
5. Le système recalcule automatiquement le total
6. Le client peut sauvegarder le panier

**Scénarios alternatifs :**
- Panier vide → Redirection vers le catalogue
- Changement de prix → Notification au client
- Rupture de stock → Suppression automatique

### UC11 - Passer une commande

**Acteur principal :** Client  
**Préconditions :** Client connecté, panier non vide  
**Scénario principal :**
1. Le client clique sur "Passer la commande"
2. Le système affiche le récapitulatif
3. Le client vérifie ses informations de livraison
4. Le client choisit le mode de livraison
5. Le client sélectionne le mode de paiement
6. Le client saisit ses informations de paiement
7. Le système traite le paiement
8. Le système génère la commande
9. Le système envoie la confirmation

**Scénarios alternatifs :**
- Paiement refusé → Retour au panier avec message
- Adresse invalide → Demande de correction
- Stock épuisé → Notification et modification

### UC12 - Suivre les commandes

**Acteur principal :** Client  
**Préconditions :** Client connecté, commandes existantes  
**Scénario principal :**
1. Le client accède à "Mes commandes"
2. Le système affiche la liste des commandes
3. Le client peut voir le statut de chaque commande
4. Le client peut consulter les détails
5. Le client peut télécharger les factures
6. Le client peut suivre la livraison

**Scénarios alternatifs :**
- Aucune commande → Message "Aucune commande"
- Commande en retard → Notification automatique

---

## ⚙️ Cas d'Usage : Administrateur

### UC20 - Gérer les produits

**Acteur principal :** Administrateur  
**Préconditions :** Administrateur connecté  
**Scénario principal :**
1. L'administrateur accède à la gestion des produits
2. Le système affiche la liste des produits
3. L'administrateur peut ajouter un nouveau produit
4. L'administrateur peut modifier un produit existant
5. L'administrateur peut supprimer un produit
6. L'administrateur peut gérer les stocks
7. Le système sauvegarde les modifications

**Scénarios alternatifs :**
- Produit en commande → Demande de confirmation
- Erreur de sauvegarde → Message d'erreur
- Image invalide → Validation automatique

### UC21 - Gérer les commandes

**Acteur principal :** Administrateur  
**Préconditions :** Administrateur connecté  
**Scénario principal :**
1. L'administrateur accède à la gestion des commandes
2. Le système affiche la liste des commandes
3. L'administrateur peut filtrer par statut
4. L'administrateur peut voir les détails d'une commande
5. L'administrateur peut changer le statut
6. L'administrateur peut traiter les retours
7. Le système met à jour les informations

**Scénarios alternatifs :**
- Commande urgente → Notification spéciale
- Paiement en attente → Relance automatique
- Livraison en retard → Contact client

### UC23 - Générer des rapports

**Acteur principal :** Administrateur  
**Préconditions :** Administrateur connecté  
**Scénario principal :**
1. L'administrateur accède aux rapports
2. Le système affiche les options de rapport
3. L'administrateur sélectionne le type de rapport
4. L'administrateur définit les paramètres
5. Le système génère le rapport
6. L'administrateur peut exporter le rapport
7. L'administrateur peut planifier des rapports

**Scénarios alternatifs :**
- Aucune donnée → Message "Aucune donnée"
- Rapport volumineux → Génération en arrière-plan
- Erreur de génération → Notification d'erreur

---

## 📊 Cas d'Usage : Gestionnaire

### UC29 - Traiter les commandes

**Acteur principal :** Gestionnaire  
**Préconditions :** Gestionnaire connecté, commandes en attente  
**Scénario principal :**
1. Le gestionnaire accède aux commandes en attente
2. Le système affiche la liste des commandes
3. Le gestionnaire vérifie la disponibilité des produits
4. Le gestionnaire valide la commande
5. Le gestionnaire prépare la commande
6. Le système met à jour le stock
7. Le système notifie le client

**Scénarios alternatifs :**
- Stock insuffisant → Commande en attente
- Produit indisponible → Contact client
- Commande urgente → Traitement prioritaire

### UC30 - Gérer les retours

**Acteur principal :** Gestionnaire  
**Préconditions :** Gestionnaire connecté, demande de retour  
**Scénario principal :**
1. Le gestionnaire consulte les demandes de retour
2. Le gestionnaire vérifie les conditions de retour
3. Le gestionnaire approuve ou refuse le retour
4. Le gestionnaire génère l'étiquette de retour
5. Le système notifie le client
6. Le gestionnaire traite le retour reçu
7. Le gestionnaire procède au remboursement

**Scénarios alternatifs :**
- Retour hors délai → Refus avec justification
- Produit endommagé → Demande de photos
- Remboursement → Traitement automatique

---

## 🔄 Cas d'Usage Système

### UC33 - Traiter le paiement

**Acteur principal :** Système de Paiement  
**Préconditions :** Commande validée, informations de paiement  
**Scénario principal :**
1. Le système reçoit les informations de paiement
2. Le système valide les données
3. Le système contacte le prestataire de paiement
4. Le prestataire traite la transaction
5. Le système reçoit la confirmation
6. Le système met à jour le statut de la commande
7. Le système génère la facture

**Scénarios alternatifs :**
- Paiement refusé → Notification d'erreur
- Transaction en attente → Relance automatique
- Erreur technique → Contact support

### UC36 - Envoyer les notifications

**Acteur principal :** Système  
**Préconditions :** Événement déclencheur  
**Scénario principal :**
1. Le système détecte un événement
2. Le système détermine le type de notification
3. Le système prépare le message
4. Le système envoie la notification
5. Le système confirme l'envoi
6. Le système enregistre la notification

**Scénarios alternatifs :**
- Échec d'envoi → Relance automatique
- Email invalide → Notification alternative
- Spam → Filtrage automatique

---

## 📋 Matrice de Traçabilité

| Cas d'Usage | Priorité | Complexité | Statut |
|-------------|----------|------------|--------|
| UC1 - Consulter les produits | Haute | Faible | ✅ Implémenté |
| UC2 - Rechercher des produits | Haute | Moyenne | 🔄 En cours |
| UC3 - Voir les détails | Haute | Faible | ✅ Implémenté |
| UC4 - S'inscrire | Haute | Moyenne | 🔄 En cours |
| UC9 - Ajouter au panier | Haute | Moyenne | ⏳ À faire |
| UC10 - Gérer le panier | Haute | Moyenne | ⏳ À faire |
| UC11 - Passer une commande | Critique | Élevée | ⏳ À faire |
| UC20 - Gérer les produits | Haute | Élevée | ⏳ À faire |
| UC21 - Gérer les commandes | Haute | Élevée | ⏳ À faire |
| UC29 - Traiter les commandes | Moyenne | Moyenne | ⏳ À faire |
| UC33 - Traiter le paiement | Critique | Élevée | ⏳ À faire |

**Légende :**
- ✅ Implémenté
- 🔄 En cours
- ⏳ À faire

---

*Document créé le : [Date]*
*Version : 1.0 - Scénarios détaillés* 