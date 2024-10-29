<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CategoriesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;

// หน้าแรก

Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::get('/invoices/{order}/download', [InvoiceController::class, 'downloadPDF'])->name('invoices.download');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');


Route::get('/invoices/{order}/download', [InvoiceController::class, 'downloadPDF'])->name('invoices.download');

Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');


Route::post('/products/{product}/purchase', [InvoiceController::class, 'createInvoice'])->name('products.purchase');
Route::get('/invoices/{invoice}', [InvoiceController::class, 'show'])->name('invoices.show');


Route::get('/', [HomeController::class, 'index'])->name('welcome');
Route::get('/products', [ProductController::class, 'index'])->name('products');


Route::prefix('products')->name('products.')->group(function () {
    Route::get('/', [ProductController::class, 'list'])->name('list');
    Route::get('/create', [ProductController::class, 'showCreateForm'])->name('create');
    Route::post('/', [ProductController::class, 'create']);
    Route::get('/{productCode}', [ProductController::class, 'show'])->name('view');
    Route::get('/{productCode}/edit', [ProductController::class, 'showEditForm'])->name('edit');
    Route::put('/{productCode}', [ProductController::class, 'update']);
    Route::delete('/{productCode}', [ProductController::class, 'delete']);
    Route::get('/{productCode}/shops', [ProductController::class, 'showShops'])->name('view-shops');
    Route::get('/{productCode}/add-shop', [ProductController::class, 'showAddShopsForm'])->name('add-shop');
    Route::post('/{productCode}/add-shop', [ProductController::class, 'addShop']);
    Route::delete('/{productCode}/remove-shop/{shopCode}', [ProductController::class, 'removeShop']);
});

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Registration Routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Social Authentication Routes
Route::get('/auth/google', [LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/auth/google/callback', [LoginController::class, 'handleGoogleCallback']);

Route::get('/auth/github', [LoginController::class, 'redirectToGithub'])->name('login.github');
Route::get('/auth/github/callback', [LoginController::class, 'handleGithubCallback']);

// กลุ่มเส้นทางที่มีการตรวจสอบสิทธิ์
Route::middleware([
    'cache.headers:no_store;no_cache;must_revalidate;max_age=0',
])->group(function () {
    Route::controller(LoginController::class)
        ->prefix('auth')
        ->group(function () {
            Route::get('/login', 'showLoginForm')->name('login');
            Route::post('/login', 'authenticate')->name('authenticate');
            Route::get('/logout', 'logout')->name('logout');
        });

    Route::middleware(['auth'])->group(function () {
        Route::controller(ProductController::class)
            ->prefix('products')
            ->name('products.')
            ->group(function () {
                Route::get('', 'list')->name('list');
                Route::get('/create', 'showCreateForm')->name('create-form');
                Route::post('/create', 'create')->name('create');
                Route::get('/{product}', 'show')->name('view');
                Route::get('/{product}/edit', 'showEditForm')->name('edit-form');
                Route::put('/{product}', 'update')->name('update');
                Route::delete('/{product}', 'delete')->name('delete');
                Route::prefix('/{product}/shops')->group(function () {
                    Route::get('', 'showShops')->name('view-shops');
                    Route::get('/add', 'showAddShopsForm')->name('add-shops-form');
                    Route::post('/add', 'addShop')->name('add-shop');
                    Route::get('/{shop}/remove', 'removeShop')->name('remove-shop');
                });
            });

        Route::controller(ShopController::class)
            ->prefix('shops')
            ->name('shops.')
            ->group(static function () {
                Route::get('', 'index')->name('list');
                Route::get('/create', 'showCreateForm')->name('create-form');
                Route::post('/create', 'create')->name('create');
                Route::get('/{shop}', 'show')->name('view');
                Route::get('/{shop}/edit', 'showEditForm')->name('edit-form');
                Route::put('/{shop}', 'update')->name('update');
                Route::delete('/{shop}', 'delete')->name('delete');
                Route::prefix('/{shop}/products')->group(static function () {
                    Route::get('', 'showProducts')->name('view-products');
                    Route::get('/add', 'showAddProductsForm')->name('add-products-form');
                    Route::post('/add', 'addProduct')->name('add-product');
                    Route::get('/{product}/remove', 'removeProduct')
                        ->name('remove-product');
                });
            });

        Route::controller(CategoriesController::class)
            ->prefix('categories')
            ->name('categories.')
            ->group(function () {
                Route::get('', 'index')->name('list');
                Route::get('/create', 'showCreateForm')->name('create-form');
                Route::post('/create', 'create')->name('create');
                Route::get('/{category}', 'show')->name('view');
                Route::get('/{category}/edit', 'showEditForm')->name('edit-form');
                Route::put('/{category}', 'update')->name('update');
                Route::delete('/{category}', 'delete')->name('delete');
                Route::prefix('/{category}/products')->group(function () {
                    Route::get('', 'showProducts')->name('view-products');
                    Route::get('/add', 'showAddProductsForm')->name('add-products-form');
                    Route::post('/add', 'addProduct')->name('add-product');
                    Route::get('/{product}/remove', 'removeProduct')->name('remove-product');
                });
            });
    });
    Route::middleware(['auth'])->group(function () {
        Route::controller(UserController::class)
            ->prefix('users')
            ->name('users.')
            ->group(function () {
                Route::get('', 'list')->name('list');
                Route::get('/create', 'showCreateForm')->name('create-form');
                Route::post('/create', 'create')->name('create');
                Route::get('/{email}', 'show')->name('view');
                Route::get('/{user}/edit', 'showEditForm')->name('edit-form');
                Route::put('/{user}', 'update')->name('update');
                Route::delete('/{user}', 'delete')->name('delete');
                Route::get('/self/{id}', 'showSelf')->name('self');
                Route::get('/self/{userId}/edit', 'showUpdateSelf')->name('update-self');
                Route::put('/self/{userId}', 'updateSelf')->name('update-self-submit');
            });
    });
});
