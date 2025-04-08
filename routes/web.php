<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Route::get('/', [ProductController::class, 'index']);   // Display form with list of products
Route::post('/submit', [ProductController::class, 'store']);    // Store a product
Route::get('/list', [ProductController::class, 'list']);    // Fetch product list
Route::put('/update/{id}', [ProductController::class, 'update']);   // Update product
