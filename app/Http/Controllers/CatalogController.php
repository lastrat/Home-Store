<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('is_active', true)
            ->with(['category', 'wishlists' => fn($q) => $q->where('user_id', auth()->id())]);

        if ($request->filled('family')) {
            $query->whereHas('category', fn($q) => $q->where('family', $request->family));
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('size')) {
            $query->where('size', $request->size);
        }

        if ($request->filled('color')) {
            $query->where('color', $request->color);
        }

        if ($request->filled('material')) {
            $query->where('material', $request->material);
        }

        if ($request->filled('min_price') || $request->filled('max_price')) {
            $query->whereBetween('price', [
                $request->min_price ?? 0,
                $request->max_price ?? 999999999,
            ]);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('sort')) {
            match ($request->sort) {
                'price_asc' => $query->orderBy('price', 'asc'),
                'price_desc' => $query->orderBy('price', 'desc'),
                'newest' => $query->orderBy('created_at', 'desc'),
                'name' => $query->orderBy('name', 'asc'),
            };
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $products = $query->paginate(24)->withQueryString();

        $categories = Category::where('is_active', true)
            ->whereNull('parent_id')
            ->with('children')
            ->orderBy('family')
            ->orderBy('name')
            ->get();

        $subcategories = Category::where('is_active', true)
            ->whereNotNull('parent_id')
            ->orderBy('family')
            ->orderBy('name')
            ->get();

        $sizes = Product::where('is_active', true)
            ->whereNotNull('size')
            ->distinct()
            ->orderBy('size')
            ->pluck('size');

        $colors = Product::where('is_active', true)
            ->whereNotNull('color')
            ->distinct()
            ->orderBy('color')
            ->pluck('color');

        $materials = Product::where('is_active', true)
            ->whereNotNull('material')
            ->distinct()
            ->orderBy('material')
            ->pluck('material');

        return view('catalog.index', compact('products', 'categories', 'subcategories', 'sizes', 'colors', 'materials'));
    }

    public function show(Product $product)
    {
        $product->load(['category', 'wishlists' => fn($q) => $q->where('user_id', auth()->id()), 'variants']);
        $related = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->where('stock', '>', 0)
            ->limit(4)
            ->get();

        return view('catalog.show', compact('product', 'related'));
    }
}
