*CAHIER DES CHARGES - SITE VITRINE & CATALOGUE PRIVÉ*

*Home Store-Chic Living*

Je veux mettre en place un site web qui présente: *catalogue privé + showroom digital + système de commande sans paiement en ligne.*

---

*1. OBJECTIF DU PROJET*
Créer un site vitrine chic qui présente l'entreprise, mais dont le catalogue produits est PRIVÉ et accessible uniquement aux clients inscrits. Pas de paiement en ligne. Le site sert à générer des commandes / réservations en boutique physique avec un reçu de validation.

*2. ARCHITECTURE DU SITE*

*A. Partie Publique (Accessible à tous)*
- Accueil
- Notre Concept / Qui sommes-nous ? 
-Nos produits (Mode & Décoration)
-Nos Activités (Vente en ligne, vente en boutique, vente à domicile et livraison)
- Notre Boutique Physique (Photos de ta façade, plan Google Maps, horaires, vidéo)
- Contact
- Bouton "Accéder au Catalogue" -> Renvoie vers Création de Compte / Connexion

*B. Partie Privée (Accès par compte obligatoire)*
- Mon Catalogue (Mode & Décoration)
- Mon Panier
- Mon Compte / Mes Coups de cœur / Mes Alertes
- Mes Reçus

*3. FONCTIONNALITÉS DÉTAILLÉES*

*3.1. INSCRIPTION & COMPTE CLIENT (Obligatoire pour voir le catalogue)*
L'accès au catalogue est bloqué. Le client doit créer un compte lié à son numéro de téléphone.

- Inscription via OTP SMS: Le numéro de téléphone est l'identifiant unique.
- Formulaire obligatoire:
 - Nom / Prénom
 - Date de naissance
 - Numéro de téléphone (vérifié par code SMS)
 - Email
 - Activité / Profession (liste déroulante: Fonctionnaire, Entrepreneur, Étudiant, Autre)
 - Quartier (Liste de choix à définir: ex: Cocody, Yopougon, Marcory...)
- Connexion: Numéro de téléphone + mot de passe / ou code OTP
- Conservation de données personnelles : Case à cocher "J'accepte..."

*3.2. CATALOGUE & FILTRES AVANCÉS*
- Deux Familles principales: *1. MODE / 2. DÉCORATION*
- Dans chaque famille: Sous-catégories (Ex: Mode -> Robes, Ensembles, Sacs... / Déco -> Salon, Luminaires, Vases...)

- *Système de filtres puissant:*
 Filtrer par: Catégorie, Taille (S, M, L, XL, Unique), Tranche de prix (ex: 10.000-25.000 FCFA), Couleur, Matière (Coton, Lin, Bois, Métal...)

- *Affichage Produit:*
 Grille avec Photo + Nom + Prix + Stock restant (ex: "Plus que 3 disponibles")
 3 Images max + 1 Vidéo courte (15-30s) par produit
 Badge: "Nouveau", "Coup de cœur", "Bientôt épuisé"

*3.3. FICHE PRODUIT*
- Galerie 3 photos + 1 vidéo
- Description + Caractéristiques (Matière, Couleur, Taille, Entretien...)
- Prix
- Stock en temps réel lié à l'ERP: Ex: "5 pièces en stock"
- *Actions:*
 1. `Ajouter au panier`
 2. `J'aime / Coup de cœur` (Même sans acheter, le client peut liker -> Donnée marketing précieuse)
 3. *Si produit épuisé:* Le produit reste visible en grisé avec bouton `Me prévenir / Je suis intéressé(e)` -> Le client est mis en liste d'attente et vous recevez une alerte.

*3.4. GESTION DU STOCK & ERP*
- *Point crucial:* Le stock affiché sur le site doit être synchronisé avec votre logiciel ERP / Gestion de stock en boutique.
- Connexion via API. Quand un produit est vendu en boutique physique, il se décrémente en ligne automatiquement.
- Si stock = 0: Passage automatique en "Épuisé" mais pas supprimé.

*3.5. PANIER & VALIDATION SANS PAIEMENT EN LIGNE*
C'est le cœur de ton système.

1. Le client constitue son panier
2. Il clique sur `Valider ma sélection`
3. Page récapitulative: Il choisit le mode de paiement souhaité: *Paiement en boutique / Mobile Money / Virement / À la livraison*
4. Il valide
5. *GÉNÉRATION AUTOMATIQUE D'UN REÇU:*
 Un reçu PDF avec Numéro de commande (ex: HS-2024-001), Liste des produits, Total, Mode de paiement choisi, Instructions "Présentez ce reçu en boutique pour finaliser votre paiement et récupérer vos articles. Réservation valable 48h"
6. Le reçu est: Affichable sur le site, téléchargeable, envoyé par WhatsApp / Email automatiquement.
7. Vous recevez la commande dans votre back-office.

*4. BACK-OFFICE ADMIN*
- Gestion clients: Voir toutes les infos (âge, quartier, activité) -> Idéal pour cibler vos pubs
- Gestion produits: Ajout facile, upload 3 photos + 1 vidéo
- Gestion stocks et alertes "Clients intéressés par un produit épuisé"
- Gestion des "J'aime": Voir les produits les plus likés
- Gestion des commandes / reçus: Valider, marquer comme payé / récupéré
- Statistiques: Produits les plus vus, quartiers qui commandent le plus

*5. DESIGN & TECHNIQUE*
- Design: Reprise de ta façade: Noir, Doré, Blanc. Très chic, épuré, luxe accessible. Priorité au mobile.
- Technologie conseillée: WordPress + WooCommerce en mode Catalogue Privé + plugin OTP SMS (Twilio) OU Développement sur mesure Laravel pour la liaison ERP
- Hébergement + Nom de domaine + SMS OTP à prévoir

Simplifié au max l’entrée des informations sur la page