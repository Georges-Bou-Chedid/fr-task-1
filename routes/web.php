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

Route::get('/registerOwner', [App\Http\Controllers\auth\RegisterOwnerController::class, 'create']);

//Create Products
Route::post('/', [App\Http\Controllers\ProductsController::class, 'store']);
Route::get('/CreateProduct', [App\Http\Controllers\ProductsController::class, 'create']);

//Update, Delete Products
Route::get('/{Product}/edit', [App\Http\Controllers\ProductsController::class, 'edit']);
Route::put('/{Product}', [App\Http\Controllers\ProductsController::class, 'update']);
Route::delete('/{Product}', [App\Http\Controllers\ProductsController::class, 'delete']);

//Fetch
Route::get('/Fetching', [App\Http\Controllers\ProductsController::class, 'fetch']);

//cart
Route::get('/cart', [App\Http\Controllers\CartController::class, 'cart']);
Route::get('/add-to-cart/{Product}' , [App\Http\Controllers\CartController::class, 'addToCart']);

//Mail for Purchase 
Route::post('/cart/{email}/{User}' , [App\Http\Controllers\MailController::class, 'store']);


Auth::routes();

//Show all Products And Show one by ID (Authenticated) And Logout
Route::get('/', [App\Http\Controllers\ProductsController::class ,'index']);
Route::get('logout', [\App\Http\Controllers\Auth\LoginController::class , 'logout']);
Route::get('/{Product}', [App\Http\Controllers\ProductsController::class, 'show']);


//Create Owner
Route::post('/register', [App\Http\Controllers\auth\RegisterOwnerController::class, 'store']);


