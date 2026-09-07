<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use App\Models\Wishlist;
use App\Models\StockAlert;
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

        return view('admin.dashboard', compact('stats', 'recentOrders', 'topProducts'));
    }
}
