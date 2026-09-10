<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
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
            $size = $request->size;
            $query->where(function ($q) use ($size) {
                $q->where('size', $size)->orWhereHas('variants', fn($q) => $q->where('size', $size));
            });
        }

        if ($request->filled('color')) {
            $color = $request->color;
            $query->where(function ($q) use ($color) {
                $q->where('color', $color)->orWhereHas('variants', fn($q) => $q->where('color', $color));
            });
        }

        if ($request->filled('material')) {
            $material = $request->material;
            $query->where(function ($q) use ($material) {
                $q->where('material', $material)->orWhereHas('variants', fn($q) => $q->where('material', $material));
            });
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

        if ($request->filled('family')) {
            $subcategories = $subcategories->where('family', $request->family);
        }

        $sizes = Product::where('is_active', true)
            ->where(function ($q) {
                $q->whereNotNull('size')->orWhereHas('variants', fn($q) => $q->whereNotNull('size'));
            })
            ->distinct()
            ->orderBy('size')
            ->pluck('size');

        $colors = Product::where('is_active', true)
            ->where(function ($q) {
                $q->whereNotNull('color')->orWhereHas('variants', fn($q) => $q->whereNotNull('color'));
            })
            ->distinct()
            ->orderBy('color')
            ->pluck('color');

        $materials = Product::where('is_active', true)
            ->where(function ($q) {
                $q->whereNotNull('material')->orWhereHas('variants', fn($q) => $q->whereNotNull('material'));
            })
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
