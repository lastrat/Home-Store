<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        SiteSetting::set('contact_email', 'contact@homestore.ci', 'string', 'contact', 'Email de réception des messages du formulaire de contact');
        SiteSetting::set('contact_phone', '+237 6 99 82 29 01', 'string', 'contact', 'Numéro de téléphone de contact');
        SiteSetting::set('contact_address', 'Akwa Nord, Douala, Cameroun', 'string', 'contact', 'Adresse physique du magasin');
        SiteSetting::set('site_name', 'Home Store - Chic Living', 'string', 'general', 'Nom du site');
        SiteSetting::set('site_description', 'Votre destination mode et décoration haut de gamme', 'string', 'general', 'Description courte du site');
    }
}
