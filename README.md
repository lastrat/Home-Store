# Home Store - Chic Living

Site vitrine et catalogue privé pour Home Store Chic Living, spécialisé dans la mode et la décoration haut de gamme.

## Fonctionnalités

### Partie Publique
- Accueil avec présentation des collections
- Notre Concept / Histoire
- Nos Activités (vente en ligne, boutique, à domicile, livraison)
- Notre Boutique Physique (photos, plan Google Maps, horaires)
- Contact

### Partie Privée (accès sur compte)
- Catalogue privé avec filtres avancés (catégorie, taille, prix, couleur, matière)
- Fiche produit avec galerie 3 photos + 1 vidéo
- Panier et validation de commande sans paiement en ligne
- Génération automatique de reçu PDF (DomPDF)
- Coups de cœur / wishlist
- Alertes stock pour produits épuisés
- Historique des commandes et reçus

### Back-office Admin
- Tableau de bord avec statistiques
- Gestion des produits et stocks
- Gestion des commandes avec mise à jour des statuts
- Gestion des clients avec données démographiques

## Stack Technique

- **Backend** : Laravel 10
- **Frontend** : Blade + Tailwind CSS + Lucide icons
- **PDF** : barryvdh/laravel-dompdf
- **Base de données** : MySQL

## Installation

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
php artisan serve
```

## Comptes de démo

- **Admin** : admin@homestore.ci / admin123
- **Client** : créer un compte via `/inscription`

## Configuration

- Twilio SMS OTP : configurer `TWILIO_SID`, `TWILIO_TOKEN`, `TWILIO_FROM` dans `.env`
- Mail : configurer les variables `MAIL_*` dans `.env`
