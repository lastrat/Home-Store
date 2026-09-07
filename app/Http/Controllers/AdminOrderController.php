<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('user');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->where('order_number', 'like', '%' . $request->search . '%')
                  ->orWhereHas('user', fn($q) => $q->where('name', 'like', '%' . $request->search . '%'));
        }

        $orders = $query->latest()->paginate(20);

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('items.product', 'user');
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:en_attente,valide,paye,recupere,annule',
        ]);

        $order->update(['status' => $request->status]);

        if ($request->status === 'paye' && !$order->paid_at) {
            $order->update(['paid_at' => now()]);
        }

        if ($request->status === 'recupere' && !$order->picked_at) {
            $order->update(['picked_at' => now()]);
        }

        return back()->with('success', 'Statut mis à jour.');
    }
}
