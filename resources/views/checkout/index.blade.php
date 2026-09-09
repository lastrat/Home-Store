@extends('layouts.app')

@section('title', 'Validation de commande - Home Store')

@section('content')
    <section class="pt-28 pb-8 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl sm:text-4xl font-bold mb-2">Validation</h1>
            <p class="text-gray-500">Finalisez votre commande</p>
        </div>
    </section>

    <section class="section bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2">
                    <div class="card p-8">
                        <h2 class="text-xl font-bold mb-6">Mode de paiement</h2>
                        <form method="POST" action="{{ route('checkout.store') }}" class="space-y-6">
                            @csrf
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <label class="cursor-pointer">
                                    <input type="radio" name="payment_method" value="boutique" class="peer sr-only" checked>
                                    <div class="card p-4 peer-checked:border-gold-500 peer-checked:ring-2 peer-checked:ring-gold-500/20 transition-all">
                                        <div class="flex items-center gap-3">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-gold-600">
                                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                            </svg>
                                            <span class="font-semibold">Paiement en boutique</span>
                                        </div>
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="payment_method" value="mobile_money" class="peer sr-only">
                                    <div class="card p-4 peer-checked:border-gold-500 peer-checked:ring-2 peer-checked:ring-gold-500/20 transition-all">
                                        <div class="flex items-center gap-3">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-gold-600">
                                                <rect x="2" y="5" width="20" height="14" rx="2"></rect>
                                                <line x1="2" y1="10" x2="22" y2="10"></line>
                                            </svg>
                                            <span class="font-semibold">Mobile Money</span>
                                        </div>
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="payment_method" value="virement" class="peer sr-only">
                                    <div class="card p-4 peer-checked:border-gold-500 peer-checked:ring-2 peer-checked:ring-gold-500/20 transition-all">
                                        <div class="flex items-center gap-3">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-gold-600">
                                                <line x1="12" y1="1" x2="12" y2="23"></line>
                                                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                            </svg>
                                            <span class="font-semibold">Virement</span>
                                        </div>
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="payment_method" value="livraison" class="peer sr-only">
                                    <div class="card p-4 peer-checked:border-gold-500 peer-checked:ring-2 peer-checked:ring-gold-500/20 transition-all">
                                        <div class="flex items-center gap-3">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-gold-600">
                                                <rect x="1" y="3" width="15" height="13"></rect>
                                                <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                                                <circle cx="5.5" cy="18.5" r="2.5"></circle>
                                                <circle cx="18.5" cy="18.5" r="2.5"></circle>
                                            </svg>
                                            <span class="font-semibold">À la livraison</span>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold mb-2">Instructions (optionnel)</label>
                                <textarea name="notes" rows="3" class="form-input" placeholder="Instructions particulières..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg w-full">Valider ma commande</button>
                        </form>
                    </div>
                </div>
                <div>
                    <div class="card p-6 space-y-4 sticky top-28">
                        <h3 class="font-bold text-lg">Récapitulatif</h3>
                        <div class="space-y-3">
                            @foreach($cart->items as $item)
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">{{ $item->product->name }} x{{ $item->quantity }}</span>
                                    <span class="font-medium">{{ number_format($item->subtotal, 0, ',', ' ') }} FCFA</span>
                                </div>
                            @endforeach
                        </div>
                        <div class="border-t border-gray-100 pt-4">
                            <div class="flex justify-between text-lg font-bold">
                                <span>Total</span>
                                <span class="text-gold-600">{{ number_format($cart->total, 0, ',', ' ') }} FCFA</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

