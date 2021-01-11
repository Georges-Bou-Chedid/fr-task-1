<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Opening
Route::get('/', [App\Http\Controllers\ProductsController::class ,'index']);

//Create Owner
Route::post('/', [App\Http\Controllers\auth\RegisterOwnerController::class, 'store']);
Route::get('/home/registerOwner', [App\Http\Controllers\auth\RegisterOwnerController::class, 'create']);

//Create Products
Route::post('/home', [App\Http\Controllers\ProductsController::class, 'store']);
Route::get('/home/CreateProduct', [App\Http\Controllers\ProductsController::class, 'create']);

//Update, Delete Products
Route::get('/home/{Product}/edit', [App\Http\Controllers\ProductsController::class, 'edit']);
Route::put('/home/{Product}', [App\Http\Controllers\ProductsController::class, 'update']);
Route::delete('/home/{Product}', [App\Http\Controllers\ProductsController::class, 'delete']);

//Fetch
Route::get('/home/Fetching', [App\Http\Controllers\ProductsController::class, 'fetch']);

//cart
Route::get('/home/cart', [App\Http\Controllers\ProductsController::class, 'cart']);
Route::get('/home/add-to-cart/{Product}' , [App\Http\Controllers\ProductsController::class, 'addToCart']);

//Mail for Purchase 
Route::post('/home/cart/{email}/{User}' , [App\Http\Controllers\MailController::class, 'store']);


Auth::routes();

//Show all Products And Show one by ID (Authenticated)
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home/{Product}', [App\Http\Controllers\ProductsController::class, 'show']);


