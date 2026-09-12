<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminClientController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminHeroSlideController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminSettingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;


Route::get('/clear-cache-temp', function () {
    Artisan::call('optimize:clear');

    return '<pre>' . Artisan::output() . '</pre>';
});


Route::get('/create-storage-link', function () {
    try {
        Artisan::call('storage:link');

        return '<h2>Storage link created successfully!</h2>';
    } catch (\Exception $e) {
        return '<h2>Error:</h2><pre>' . $e->getMessage() . '</pre>';
    }
});

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/concept', [HomeController::class, 'concept'])->name('concept');
Route::get('/activites', [HomeController::class, 'activities'])->name('activities');
Route::get('/boutique', [HomeController::class, 'boutique'])->name('boutique');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

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
    Route::post('/otp/renvoyer', [AuthController::class, 'resendOtp'])->name('otp.resend');
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

        Route::post('/ajax/cart/add/{product}', [CartController::class, 'add'])->name('ajax.cart.add');
        Route::post('/ajax/cart/wishlist/{product}', [CartController::class, 'toggleWishlist'])->name('ajax.wishlist.toggle');
        Route::post('/ajax/cart/alert/{product}', [CartController::class, 'toggleStockAlert'])->name('ajax.stock.alert.toggle');
        Route::get('/ajax/cart/count', [CartController::class, 'count'])->name('ajax.cart.count');

        Route::post('/produit/{product}/like', [ProductController::class, 'like'])->name('product.like');
        Route::post('/produit/{product}/interest', [ProductController::class, 'expressInterest'])->name('product.interest');
        Route::get('/produit/{product}/view', [ProductController::class, 'trackView'])->name('product.view');
        Route::get('/ajax/products/likes', [ProductController::class, 'getLikesCount'])->name('ajax.product.likes');

        Route::get('/commande', [CheckoutController::class, 'index'])->name('checkout.index');
        Route::post('/commande', [CheckoutController::class, 'store'])->name('checkout.store');
        Route::get('/commande/{order}', [CheckoutController::class, 'receipt'])->name('checkout.receipt');
        Route::get('/commande/{order}/recu', [CheckoutController::class, 'downloadReceipt'])->name('checkout.receipt.download');
        Route::get('/commande/{order}/payment-proof', [CheckoutController::class, 'downloadPaymentProof'])->name('checkout.payment_proof.download');

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

    Route::get('/categories', [AdminCategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/creer', [AdminCategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [AdminCategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/modifier', [AdminCategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [AdminCategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [AdminCategoryController::class, 'destroy'])->name('categories.destroy');

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

    Route::get('/slides', [AdminHeroSlideController::class, 'index'])->name('hero_slides.index');
    Route::get('/slides/creer', [AdminHeroSlideController::class, 'create'])->name('hero_slides.create');
    Route::post('/slides', [AdminHeroSlideController::class, 'store'])->name('hero_slides.store');
    Route::get('/slides/{hero_slide}/modifier', [AdminHeroSlideController::class, 'edit'])->name('hero_slides.edit');
    Route::put('/slides/{hero_slide}', [AdminHeroSlideController::class, 'update'])->name('hero_slides.update');
    Route::delete('/slides/{hero_slide}', [AdminHeroSlideController::class, 'destroy'])->name('hero_slides.destroy');

    Route::get('/parametres', [AdminSettingController::class, 'index'])->name('settings.index');
    Route::put('/parametres', [AdminSettingController::class, 'update'])->name('settings.update');
});
