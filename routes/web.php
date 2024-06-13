<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware'=>'auth'], function (){
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/home', [HomeController::class, 'index'])->name('home.index');

    Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
    Route::get('menu/pizza', [MenuController::class, 'getPizzas'])->name('pizza.index');
    Route::get('menu/coffee', [MenuController::class, 'getCoffee'])->name('coffee.index');
    Route::get('/get-price', [MenuController::class, 'getPrice']);

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart/count', [CartController::class, 'getCartItemCount']);
    Route::delete('cart/{id}', [CartController::class, 'delete'])->name('cart.delete');

    Route::post('/order/create', [OrderController::class, 'create'])->name('order.create');
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::group(['middleware'=>'guest'], function (){
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
});

Route::get('/about', [HomeController::class, 'about'])->name('about.index');
