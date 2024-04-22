<?php

use App\Http\Controllers\Application\ProductController;
use App\Http\Controllers\Application\HomeController;
use App\Http\Controllers\Application\ProfileController;
use App\Http\Controllers\AuthController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Authentication
Route::get('/', [AuthController::class, 'index'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('application')->middleware('auth')->group(function() {
    Route::prefix('product')->group(function() {
        Route::get('/', [ProductController::class, 'index'])->name('product');
        Route::get('/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/store', [ProductController::class, 'store'])->name('product.store');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
        Route::put('/update/{id}', [ProductController::class, 'update'])->name('product.update');
        Route::delete('/destroy/{id}', [ProductController::class, 'destroy'])->name('product.delete');
        Route::get('/export', [ProductController::class, 'export'])->name('product.export');
    });

    Route::prefix('profile')->group(function() {
        Route::get('/', [ProfileController::class, 'index'])->name('profile');
    });
});