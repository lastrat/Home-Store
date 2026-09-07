<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminClientController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/concept', [HomeController::class, 'concept'])->name('concept');
Route::get('/activites', [HomeController::class, 'activities'])->name('activities');
Route::get('/boutique', [HomeController::class, 'boutique'])->name('boutique');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

Route::middleware('guest')->group(function () {
    Route::get('/connexion', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/connexion', [AuthController::class, 'login']);

    Route::get('/inscription', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/inscription', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/otp/verification', [AuthController::class, 'showOtpVerify'])->name('otp.verify.form');
    Route::post('/otp/envoyer', [AuthController::class, 'sendOtp'])->name('otp.send');
    Route::post('/otp/verifier', [AuthController::class, 'verifyOtp'])->name('otp.verify');

    Route::middleware('otp.verified')->group(function () {
        Route::get('/catalogue', [CatalogController::class, 'index'])->name('catalog.index');
        Route::get('/catalogue/produit/{product}', [CatalogController::class, 'show'])->name('catalog.show');

        Route::get('/panier', [CartController::class, 'index'])->name('cart.index');
        Route::post('/panier/ajouter/{product}', [CartController::class, 'add'])->name('cart.add');
        Route::put('/panier/item/{item}', [CartController::class, 'update'])->name('cart.update');
        Route::delete('/panier/item/{item}', [CartController::class, 'remove'])->name('cart.remove');
        Route::delete('/panier/vider', [CartController::class, 'clear'])->name('cart.clear');
        Route::post('/panier/favoris/{product}', [CartController::class, 'toggleWishlist'])->name('wishlist.toggle');
        Route::post('/panier/alerte/{product}', [CartController::class, 'toggleStockAlert'])->name('stock.alert.toggle');

        Route::get('/commande', [CheckoutController::class, 'index'])->name('checkout.index');
        Route::post('/commande', [CheckoutController::class, 'store'])->name('checkout.store');
        Route::get('/commande/{order}', [CheckoutController::class, 'receipt'])->name('checkout.receipt');
        Route::get('/commande/{order}/recu', [CheckoutController::class, 'downloadReceipt'])->name('checkout.receipt.download');

        Route::middleware('otp.verified')->group(function () {
            Route::get('/mon-compte', [AccountController::class, 'index'])->name('account.index');
            Route::get('/mon-compte/commandes', [AccountController::class, 'orders'])->name('account.orders');
            Route::get('/mon-compte/commandes/{order}', [AccountController::class, 'orderShow'])->name('account.order.show');
            Route::get('/mon-compte/favoris', [AccountController::class, 'wishlists'])->name('account.wishlists');
            Route::get('/mon-compte/alertes', [AccountController::class, 'stockAlerts'])->name('account.alerts');
        });
    });
});

Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/tableau-de-bord', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('/produits', [AdminProductController::class, 'index'])->name('products.index');
    Route::get('/produits/creer', [AdminProductController::class, 'create'])->name('products.create');
    Route::post('/produits', [AdminProductController::class, 'store'])->name('products.store');
    Route::get('/produits/{product}/modifier', [AdminProductController::class, 'edit'])->name('products.edit');
    Route::put('/produits/{product}', [AdminProductController::class, 'update'])->name('products.update');
    Route::delete('/produits/{product}', [AdminProductController::class, 'destroy'])->name('products.destroy');

    Route::get('/commandes', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/commandes/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::put('/commandes/{order}/statut', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');

    Route::get('/clients', [AdminClientController::class, 'index'])->name('clients.index');
    Route::get('/clients/{client}', [AdminClientController::class, 'show'])->name('clients.show');
});
