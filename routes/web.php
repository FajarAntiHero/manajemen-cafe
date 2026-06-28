<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DapurController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrdersController;

Route::get('/', function () {
    return view('homepage');
})->name('homepage');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'create'])->name('login');
    Route::post('/login', [AuthController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('/orders', [OrdersController::class, 'index'])->name('admin.orders');
    Route::get('/orders/search', [OrdersController::class, 'index'])->name('admin.orders.search');
    Route::get('/orders/create', [OrdersController::class, 'create'])->name('admin.orders.create');
    Route::post('/orders/create', [OrdersController::class, 'store'])->name('admin.orders.store');
    Route::get('/orders/{order}', [OrdersController::class, 'show'])->name('admin.orders.show');
    Route::get('/orders/{order}/edit', [OrdersController::class, 'edit'])->name('admin.orders.edit');
    Route::get('/orders/{order}/items', [OrdersController::class, 'getItems'])->name('admin.orders.items');
    Route::put('/orders/{order}', [OrdersController::class, 'update'])->name('admin.orders.update');
    Route::delete('/orders/{order}', [OrdersController::class, 'destroy'])->name('admin.orders.destroy');

    Route::get('menus/search', [MenuController::class, 'search'])->name('admin.menus.search');

    Route::get('/users/{user}/detailUser', [UserController::class, 'detailUser'])->name('admin.users.detailUser');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
    // admin menus
    Route::get('/menus', [MenuController::class, 'index'])->name('admin.menus');
    Route::get('/menus/create', [MenuController::class, 'create'])->name('admin.menus.create');
    Route::post('/menus', [MenuController::class, 'store'])->name('admin.menus.store');
    Route::get('/menus/{menu}/edit', [MenuController::class, 'edit'])->name('admin.menus.edit');
    Route::put('/menus/{menu}', [MenuController::class, 'update'])->name('admin.menus.update');
    Route::delete('/menus/{menu}', [MenuController::class, 'destroy'])->name('admin.menus.destroy');

    // admin ingredients
    // Route::get('/ingredients', [IngredientController::class, 'index'])->name('admin.ingredients');
    // Route::get('/ingredients/create', [IngredientController::class, 'create'])->name('admin.ingredients.create');
    // Route::post('/ingredients', [IngredientController::class, 'store'])->name('admin.ingredients.store');
    // Route::get('/ingredients/{ingredient}/edit', [IngredientController::class, 'edit'])->name('admin.ingredients.edit');
    // Route::put('/ingredients/{ingredient}', [IngredientController::class, 'update'])->name('admin.ingredients.update');
    // Route::delete('/ingredients/{ingredient}', [IngredientController::class, 'destroy'])->name('admin.ingredients.destroy');
    
    // admin users
    Route::get('/users', [UserController::class, 'index'])->name('admin.users');
    Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{user}', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    
});

