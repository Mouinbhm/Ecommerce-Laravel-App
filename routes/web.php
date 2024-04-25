<?php

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/client/dashboard', [ClientController::class, 'dashboard'])->name('client.dashboard');



Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/categories', [CategoryController::class, 'index']);
    Route::post('/admin/category/store', [CategoryController::class, 'store']);
    Route::get('/admin/category/{id}/delete', [CategoryController::class, 'destroy']);
    Route::post('/admin/category/update', [CategoryController::class, 'update']);
});



/*Route product*/
Route::get('/admin/products', [ProductController::class, 'index']);
Route::post('/admin/product/store', [ProductController::class, 'store']);
Route::get('/admin/product/{id}/delete', [ProductController::class, 'destroy']);
Route::post('/admin/product/update', [ProductController::class, 'update']);