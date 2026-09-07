<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\JsonResponse;
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
                return $this->jsonOrBack('Stock insuffisant.', 'error', 422);
            }
            $item->update(['quantity' => $newQty]);
        } else {
            if ($product->stock < $quantity) {
                return $this->jsonOrBack('Stock insuffisant.', 'error', 422);
            }
            $cart->items()->create(['product_id' => $product->id, 'quantity' => $quantity]);
        }

        $cartCount = $cart->items()->sum('quantity');

        return $this->jsonOrBack('Produit ajouté au panier.', 'success', 200, ['cart_count' => $cartCount]);
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
            $active = false;
        } else {
            Wishlist::create(['user_id' => auth()->id(), 'product_id' => $product->id]);
            $message = 'Ajouté aux coups de cœur!';
            $active = true;
        }

        return $this->jsonOrBack($message, 'success', 200, ['active' => $active ?? false]);
    }

    public function toggleStockAlert(Product $product)
    {
        if ($product->stock > 0) {
            return $this->jsonOrBack('Ce produit est encore en stock.', 'error', 422);
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

        return $this->jsonOrBack($message, 'success');
    }

    public function count(): JsonResponse
    {
        $cart = Cart::where('user_id', auth()->id())->first();
        $count = $cart ? $cart->items()->sum('quantity') : 0;

        return response()->json(['count' => $count]);
    }

    private function jsonOrBack(string $message, string $type = 'success', int $status = 200, array $extra = []): JsonResponse|\Illuminate\Http\RedirectResponse
    {
        if (request()->ajax() || request()->wantsJson()) {
            return response()->json(array_merge([
                'success' => $type === 'success',
                'message' => $message,
            ], $extra), $status);
        }

        return back()->with($type, $message);
    }
}
