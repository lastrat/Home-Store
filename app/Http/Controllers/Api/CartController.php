<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\StockAlert;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add(Request $request, Product $product): JsonResponse
    {
        $request->validate([
            'quantity' => 'nullable|integer|min:1|max:' . $product->stock,
        ]);

        $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);
        $item = $cart->items()->where('product_id', $product->id)->first();

        $quantity = $request->quantity ?? 1;

        if ($item) {
            $newQty = $item->quantity + $quantity;
            if ($newQty > $product->stock) {
                return response()->json(['success' => false, 'message' => 'Stock insuffisant.'], 422);
            }
            $item->update(['quantity' => $newQty]);
        } else {
            if ($product->stock < $quantity) {
                return response()->json(['success' => false, 'message' => 'Stock insuffisant.'], 422);
            }
            $cart->items()->create(['product_id' => $product->id, 'quantity' => $quantity]);
        }

        $cartCount = $cart->items()->sum('quantity');

        return response()->json([
            'success' => true,
            'message' => 'Produit ajouté au panier.',
            'cart_count' => $cartCount,
        ]);
    }

    public function toggleWishlist(Product $product): JsonResponse
    {
        $wishlist = Wishlist::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        if ($wishlist) {
            $wishlist->delete();
            $message = 'Retiré des coups de cœur.';
            $active = false;
        } else {
            Wishlist::create(['user_id' => auth()->id(), 'product_id' => $product->id]);
            $message = 'Ajouté aux coups de cœur!';
            $active = true;
        }

        return response()->json([
            'success' => true,
            'message' => $message,
            'active' => $active,
        ]);
    }

    public function toggleStockAlert(Product $product): JsonResponse
    {
        if ($product->stock > 0) {
            return response()->json(['success' => false, 'message' => 'Ce produit est encore en stock.'], 422);
        }

        $alert = StockAlert::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        if ($alert) {
            $alert->delete();
            $message = 'Alerte retirée.';
            $active = false;
        } else {
            StockAlert::create(['user_id' => auth()->id(), 'product_id' => $product->id]);
            $message = 'Vous serez alerté quand le produit sera disponible!';
            $active = true;
        }

        return response()->json([
            'success' => true,
            'message' => $message,
            'active' => $active,
        ]);
    }

    public function count(): JsonResponse
    {
        $cart = Cart::where('user_id', auth()->id())->first();
        $count = $cart ? $cart->items()->sum('quantity') : 0;

        return response()->json(['count' => $count]);
    }
}
