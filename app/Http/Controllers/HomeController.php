<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Neighborhood;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
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

        return view('home', compact('featuredProducts', 'newProducts', 'decoProducts'));
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
