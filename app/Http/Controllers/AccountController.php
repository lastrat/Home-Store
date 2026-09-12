<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Wishlist;
use App\Models\StockAlert;
use App\Models\ProductInterest;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $wishlists = Wishlist::where('user_id', $user->id)
            ->with('product.category')
            ->latest()
            ->paginate(12);

        $stockAlerts = StockAlert::where('user_id', $user->id)
            ->with('product')
            ->latest()
            ->paginate(12);

        $orders = Order::where('user_id', $user->id)
            ->latest()
            ->paginate(10);

        return view('account.index', compact('user', 'wishlists', 'stockAlerts', 'orders'));
    }

    public function orders()
    {
        $orders = Order::where('user_id', auth()->id())->latest()->paginate(10);
        return view('account.orders', compact('orders'));
    }

    public function orderShow(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }
        $order->load('items.product');
        return view('account.order-show', compact('order'));
    }

    public function wishlists()
    {
        $wishlists = Wishlist::where('user_id', auth()->id())
            ->with('product.category')
            ->latest()
            ->paginate(12);

        return view('account.wishlists', compact('wishlists'));
    }

    public function stockAlerts()
    {
        $stockAlerts = StockAlert::where('user_id', auth()->id())
            ->with('product')
            ->latest()
            ->get();

        $interests = ProductInterest::where('user_id', auth()->id())
            ->with('product')
            ->latest()
            ->get();

        $alerts = $stockAlerts->merge($interests)->sortByDesc('created_at')->values();

        return view('account.alerts', compact('alerts'));
    }
}
