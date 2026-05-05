<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| CONTROLLERS
|--------------------------------------------------------------------------
*/

// ADMIN
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\SettingController;

// CLIENT
use App\Http\Controllers\Client\DashboardController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\ProductController as ClientProductController;
use App\Http\Controllers\Client\ProfileController as ClientProfileController;
use App\Http\Controllers\Client\OrderController as ClientOrderController;
use App\Http\Controllers\Client\CheckoutController;

/*
|--------------------------------------------------------------------------
| 🌐 PUBLIC
|--------------------------------------------------------------------------
*/

Route::view('/', 'welcome')->name('welcome');

/*
|--------------------------------------------------------------------------
| 🔐 AUTH REDIRECTION
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->get('/dashboard', function () {
    return auth()->user()->role === 'admin'
        ? redirect()->route('admin.dashboard')
        : redirect()->route('client.dashboard');
})->name('dashboard');

/*
|--------------------------------------------------------------------------
| 👑 ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

        // Produits
        Route::resource('products', AdminProductController::class);

        // Commandes
        Route::prefix('orders')->name('orders.')->group(function () {
            Route::get('/', [AdminOrderController::class, 'index'])->name('index');
            Route::get('/{order}', [AdminOrderController::class, 'show'])->name('show');
            Route::put('/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('updateStatus');
        });

        // Clients
        Route::prefix('clients')->name('clients.')->group(function () {
            Route::get('/', [ClientController::class, 'index'])->name('index');
            Route::get('/{user}', [ClientController::class, 'show'])->name('show');
        });

        // Paiements
        Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');

        // Statistiques
        Route::get('/stats', [AdminController::class, 'stats'])->name('stats');

        // Paramètres
        Route::prefix('settings')->name('settings.')->group(function () {
            Route::get('/', [SettingController::class, 'index'])->name('index');
            Route::post('/', [SettingController::class, 'update'])->name('update');
        });
    });

/*
/*
|--------------------------------------------------------------------------
| 👤 CLIENT ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/client/dashboard', [DashboardController::class, 'index'])
        ->name('client.dashboard');

    // Produits
    Route::get('/products', [ClientProductController::class, 'index'])
        ->name('products.index');

    // Panier
    Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('/add/{id}', [CartController::class, 'add'])->name('add');
        Route::delete('/remove/{id}', [CartController::class, 'remove'])->name('remove');
    });

    // 📦 COMMANDES (PROPRE)
    Route::prefix('client/orders')->name('client.orders.')->group(function () {

        // Voir ses commandes
        Route::get('/', [ClientOrderController::class, 'index'])->name('index');

        // Créer une commande
        Route::post('/', [ClientOrderController::class, 'store'])->name('store');

        // Voir détail commande
        Route::get('/{order}', [ClientOrderController::class, 'show'])->name('show');
   // annuler  commande
     Route::patch('/{order}/cancel', [ClientOrderController::class, 'cancel'])
    ->name('cancel');

    Route::delete('/{order}', [ClientOrderController::class, 'destroy'])
    ->name('destroy');

        });

    // Profil
    Route::prefix('profile')->group(function () {
        Route::get('/', [ClientProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/', [ClientProfileController::class, 'update'])->name('profile.update');
        Route::put('/password', [ClientProfileController::class, 'updatePassword'])->name('profile.password');
    });

    // Checkout
    Route::prefix('client')->group(function () {
        Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
        Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
    });

});

/*
|--------------------------------------------------------------------------
| 🔐 AUTH (Laravel)
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
