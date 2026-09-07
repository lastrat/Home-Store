<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);
        $cart->load('items.product.category');

        return view('cart.index', compact('cart'));
    }

    public function add(Request $request, Product $product)
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
                return back()->with('error', 'Stock insuffisant.');
            }
            $item->update(['quantity' => $newQty]);
        } else {
            if ($product->stock < $quantity) {
                return back()->with('error', 'Stock insuffisant.');
            }
            $cart->items()->create(['product_id' => $product->id, 'quantity' => $quantity]);
        }

        return back()->with('success', 'Produit ajouté au panier.');
    }

    public function update(Request $request, CartItem $item)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $item->product->stock,
        ]);

        $item->update(['quantity' => $request->quantity]);

        return back()->with('success', 'Panier mis à jour.');
    }

    public function remove(CartItem $item)
    {
        $item->delete();

        return back()->with('success', 'Produit retiré du panier.');
    }

    public function clear()
    {
        $cart = Cart::where('user_id', auth()->id())->first();
        if ($cart) {
            $cart->items()->delete();
        }

        return back()->with('success', 'Panier vidé.');
    }

    public function toggleWishlist(Product $product)
    {
        $wishlist = Wishlist::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        if ($wishlist) {
            $wishlist->delete();
            $message = 'Retiré des coups de cœur.';
        } else {
            Wishlist::create(['user_id' => auth()->id(), 'product_id' => $product->id]);
            $message = 'Ajouté aux coups de cœur!';
        }

        return back()->with('success', $message);
    }

    public function toggleStockAlert(Product $product)
    {
        if ($product->stock > 0) {
            return back()->with('error', 'Ce produit est encore en stock.');
        }

        $alert = StockAlert::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        if ($alert) {
            $alert->delete();
            $message = 'Alerte retirée.';
        } else {
            StockAlert::create(['user_id' => auth()->id(), 'product_id' => $product->id]);
            $message = 'Vous serez alerté quand le produit sera disponible!';
        }

        return back()->with('success', $message);
    }
}
