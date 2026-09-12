<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Cart::where('user_id', auth()->id())->firstOrFail();
        $cart->load('items.product.category', 'items.variant');

        if ($cart->items->isEmpty()) {
            return redirect()->route('catalog.index')->with('error', 'Votre panier est vide.');
        }

        $paymentDetails = [
            'mobile_money' => SiteSetting::get('payment_mobile_money_number', ''),
            'virement' => SiteSetting::get('payment_virement_details', ''),
            'boutique' => SiteSetting::get('payment_boutique_details', ''),
        ];

        return view('checkout.index', compact('cart', 'paymentDetails'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:boutique,mobile_money,virement,livraison',
            'notes' => 'nullable|string|max:1000',
            'payment_proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf,heic,heif|max:5120',
        ]);

        $cart = Cart::where('user_id', auth()->id())->with('items.product', 'items.variant')->firstOrFail();

        if ($cart->items->isEmpty()) {
            return redirect()->route('catalog.index')->with('error', 'Votre panier est vide.');
        }

        $orderNumber = 'HS-' . now()->year . '-' . str_pad(Order::count() + 1, 3, '0', STR_PAD_LEFT);

        $data = [
            'user_id' => auth()->id(),
            'order_number' => $orderNumber,
            'total' => $cart->total,
            'payment_method' => $request->payment_method,
            'status' => 'en_attente',
            'notes' => $request->notes,
        ];

        if ($request->hasFile('payment_proof')) {
            $path = $request->file('payment_proof')->store('payment-proofs', 'public');
            $data['payment_proof'] = $path;
            $data['payment_status'] = 'pending_review';
        } else {
            $data['payment_status'] = $request->payment_method === 'boutique' || $request->payment_method === 'livraison' ? 'no_proof' : 'pending_proof';
        }

        $order = Order::create($data);

        foreach ($cart->items as $item) {
            $price = $item->variant ? $item->product->price + $item->variant->price_adjustment : $item->product->price;

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'product_variant_id' => $item->product_variant_id,
                'product_name' => $item->product->name . ($item->variant ? ' (' . trim(($item->variant->size ? $item->variant->size . ' / ' : '') . ($item->variant->color ? $item->variant->color . ' / ' : '') . ($item->variant->material ? $item->variant->material : ''), ' / ') . ')' : ''),
                'product_price' => $price,
                'quantity' => $item->quantity,
                'subtotal' => $price * $item->quantity,
            ]);

            if ($item->variant) {
                $item->variant->decrement('stock', $item->quantity);
            } else {
                $item->product->decrement('stock', $item->quantity);
            }
        }

        $cart->items()->delete();

        return redirect()->route('checkout.receipt', $order)->with('success', 'Commande créée avec succès!');
    }

    public function receipt(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load('items.product', 'items.variant', 'user');

        return view('checkout.receipt', compact('order'));
    }

    public function downloadReceipt(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load('items.product', 'items.variant', 'user');

        $pdf = Pdf::loadView('checkout.receipt-pdf', compact('order'))
            ->setPaper('A4', 'portrait');

        return $pdf->download("recu-{$order->order_number}.pdf");
    }

    public function downloadPaymentProof(Order $order)
    {
        $user = auth()->user();

        if (!$user || (! $user->is_admin && $order->user_id !== $user->id)) {
            abort(403);
        }

        if (!$order->payment_proof) {
            abort(404);
        }

        $path = storage_path('app/public/' . $order->payment_proof);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->download($path);
    }
}
