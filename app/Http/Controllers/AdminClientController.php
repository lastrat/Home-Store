<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class AdminClientController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('is_admin', false);

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('phone', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('profession')) {
            $query->where('profession', $request->profession);
        }

        $clients = $query->withCount('orders')->latest()->paginate(20);

        return view('admin.clients.index', compact('clients'));
    }

    public function show(User $client)
    {
        if ($client->is_admin) {
            abort(404);
        }

        $client->load('neighborhood', 'orders', 'wishlists', 'stockAlerts');
        $orders = $client->orders()->latest()->paginate(10);

        return view('admin.clients.show', compact('client', 'orders'));
    }
}
