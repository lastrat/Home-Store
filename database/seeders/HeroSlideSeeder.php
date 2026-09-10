<?php

namespace Database\Seeders;

use App\Models\HeroSlide;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class HeroSlideSeeder extends Seeder
{
    public function run(): void
    {
        $slides = [
            [
                'title' => 'Collection Été 2026',
                'subtitle' => 'Des pièces légères et colorées pour une saison radieuse. Découvrez nos nouveautés mode.',
                'badge_text' => 'Nouveau',
                'button_text' => 'Découvrir',
                'button_link' => '/catalogue',
                'button2_text' => 'Vente à domicile',
                'button2_link' => '/activities',
                'type' => 'mode',
                'order' => 1,
                'is_active' => true,
                'image_url' => 'https://images.unsplash.com/photo-1445205170230-053b83016050?w=1920&q=80',
            ],
            [
                'title' => 'Chic Living',
                'subtitle' => 'L\'élégance intérieure pour un chez-vous qui vous ressemble. Explorez notre collection décoration.',
                'badge_text' => 'Exclusif',
                'button_text' => 'Voir la collection',
                'button_link' => '/catalogue?category_id=decoration',
                'button2_text' => 'Nous contacter',
                'button2_link' => '/contact',
                'type' => 'decoration',
                'order' => 2,
                'is_active' => true,
                'image_url' => 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?w=1920&q=80',
            ],
            [
                'title' => 'Vente à Domicile',
                'subtitle' => 'Notre équipe se déplace chez vous pour une expérience shopping personnalisée et unique.',
                'badge_text' => 'Service',
                'button_text' => 'En savoir plus',
                'button_link' => '/activities',
                'button2_text' => 'Commander',
                'button2_link' => '/register',
                'type' => 'mode',
                'order' => 3,
                'is_active' => true,
                'image_url' => 'https://images.unsplash.com/photo-1490481651871-ab68de25d43d?w=1920&q=80',
            ],
            [
                'title' => 'Ambiance & Design',
                'subtitle' => 'Transformez votre intérieur avec nos pièces de décoration soigneusement sélectionnées.',
                'badge_text' => 'Tendance',
                'button_text' => 'Explorer',
                'button_link' => '/catalogue?category_id=decoration',
                'button2_text' => 'Click & Collect',
                'button2_link' => '/activities',
                'type' => 'decoration',
                'order' => 4,
                'is_active' => true,
                'image_url' => 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=1920&q=80',
            ],
        ];

        foreach ($slides as $slideData) {
            $imageUrl = $slideData['image_url'];
            $filename = 'hero-slides/' . uniqid() . '.jpg';

            try {
                $response = Http::timeout(30)
                    ->withoutVerifying()
                    ->get($imageUrl);

                if ($response->successful()) {
                    Storage::disk('public')->put($filename, $response->body());

                    HeroSlide::create([
                        'title' => $slideData['title'],
                        'subtitle' => $slideData['subtitle'],
                        'background_image' => $filename,
                        'badge_text' => $slideData['badge_text'],
                        'button_text' => $slideData['button_text'],
                        'button_link' => $slideData['button_link'],
                        'button2_text' => $slideData['button2_text'],
                        'button2_link' => $slideData['button2_link'],
                        'type' => $slideData['type'],
                        'order' => $slideData['order'],
                        'is_active' => $slideData['is_active'],
                    ]);
                }
            } catch (\Exception $e) {
                continue;
            }
        }
    }
}
