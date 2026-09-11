<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\HeroSlide;
use App\Models\Product;
use App\Models\Neighborhood;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $heroSlides = HeroSlide::active()->ordered()->get();

        if (auth()->check()) {
            $featuredProducts = Product::where('is_featured', true)
                ->where('is_active', true)
                ->where('stock', '>', 0)
                ->with('category')
                ->latest()
                ->take(8)
                ->get();

            $newProducts = Product::where('is_active', true)
                ->where('stock', '>', 0)
                ->whereHas('category', function ($q) {
                    $q->where('family', 'mode');
                })
                ->with('category')
                ->latest()
                ->take(4)
                ->get();

            $decoProducts = Product::where('is_active', true)
                ->where('stock', '>', 0)
                ->whereHas('category', function ($q) {
                    $q->where('family', 'decoration');
                })
                ->with('category')
                ->latest()
                ->take(4)
                ->get();
        } else {
            $featuredProducts = collect();
            $newProducts = collect();
            $decoProducts = collect();
        }

        $categoryShowcases = [
            [
                'name' => 'Vêtements',
                'family' => 'mode',
                'category_slugs' => ['robes', 'ensembles'],
                'description' => 'Des pièces raffinées pour femme, des coupes modernes et des matières nobles.',
                'link' => route('catalog.index', ['family' => 'mode']),
            ],
            [
                'name' => 'Chaussure',
                'family' => 'mode',
                'category_slugs' => ['chaussures'],
                'description' => 'Une sélection de chaussures élégantes et confortables pour toutes les occasions.',
                'link' => route('catalog.index', ['family' => 'mode']),
            ],
            [
                'name' => 'Accessoire',
                'family' => 'mode',
                'category_slugs' => ['accessoires', 'sacs'],
                'description' => 'Complétez votre look avec nos accessoires soigneusement choisis.',
                'link' => route('catalog.index', ['family' => 'mode']),
            ],
            [
                'name' => 'Décoration intérieure',
                'family' => 'decoration',
                'category_slugs' => ['salon', 'luminaires', 'vases', 'coussins', 'mobilier'],
                'description' => 'Transformez votre intérieur avec nos pièces de décoration chic et authentiques.',
                'link' => route('catalog.index', ['family' => 'decoration']),
            ],
        ];

        foreach ($categoryShowcases as &$showcase) {
            $showcase['products'] = Product::where('is_active', true)
                ->where('stock', '>', 0)
                ->whereHas('category', function ($q) use ($showcase) {
                    $q->where('family', $showcase['family'])
                        ->whereIn('slug', $showcase['category_slugs']);
                })
                ->with('category')
                ->latest()
                ->take(8)
                ->get();
        }

        return view('home', compact('heroSlides', 'featuredProducts', 'newProducts', 'decoProducts', 'categoryShowcases'));
    }

    public function concept()
    {
        return view('concept');
    }

    public function activities()
    {
        return view('activities');
    }

    public function boutique()
    {
        return view('boutique');
    }

    public function contact()
    {
        return view('contact');
    }
}
