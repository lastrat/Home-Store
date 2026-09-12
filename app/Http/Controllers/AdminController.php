<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use App\Models\Wishlist;
use App\Models\StockAlert;
use App\Models\ProductInterest;
use App\Models\ProductLike;
use App\Models\ProductView;
use App\Models\City;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'products' => Product::count(),
            'orders' => Order::count(),
            'clients' => User::where('is_admin', false)->count(),
            'revenue' => Order::where('status', '!=', 'annule')->sum('total'),
        ];

        $recentOrders = Order::with('user')->latest()->take(10)->get();
        $topProducts = Product::withCount('orderItems')
            ->orderBy('order_items_count', 'desc')
            ->take(5)
            ->get();

        $topLikedProducts = Product::withCount('likes')
            ->orderBy('likes_count', 'desc')
            ->take(5)
            ->get();

        $topViewedProducts = Product::withCount('views')
            ->orderBy('views_count', 'desc')
            ->take(5)
            ->get();

        $topCities = City::withCount('orders')
            ->orderBy('orders_count', 'desc')
            ->take(5)
            ->get();

        $productInterests = ProductInterest::with('product', 'user')
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'recentOrders',
            'topProducts',
            'topLikedProducts',
            'topViewedProducts',
            'topCities',
            'productInterests'
        ));
    }
}
