<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductInterest;
use App\Models\ProductLike;
use App\Models\ProductView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function like(Product $product)
    {
        $userId = Auth::id();
        $existing = ProductLike::where('user_id', $userId)
            ->where('product_id', $product->id)
            ->first();

        if ($existing) {
            $existing->delete();
            $liked = false;
        } else {
            ProductLike::create([
                'user_id' => $userId,
                'product_id' => $product->id,
            ]);
            $liked = true;
        }

        if (request()->expectsJson()) {
            return response()->json([
                'liked' => $liked,
                'likes_count' => $product->likes()->count(),
            ]);
        }

        return back();
    }

    public function expressInterest(Product $product)
    {
        $interest = ProductInterest::firstOrCreate([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
        ]);

        if (request()->expectsJson()) {
            return response()->json([
                'interested' => true,
                'message' => 'Vous serez notifié lorsque ce produit sera de nouveau disponible.',
            ]);
        }

        return back()->with('success', 'Vous serez notifié lorsque ce produit sera de nouveau disponible.');
    }

    public function trackView(Product $product)
    {
        ProductView::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
        ]);

        if (request()->expectsJson()) {
            return response()->json(['views_count' => $product->views()->count()]);
        }

        return back();
    }

    public function getLikesCount(Product $product)
    {
        return response()->json([
            'likes_count' => $product->likes()->count(),
            'is_liked' => auth()->check() && $product->likes()->where('user_id', auth()->id())->exists(),
        ]);
    }
}
