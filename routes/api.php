<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * Buyers
 */
Route::apiResource('buyers', \App\Http\Controllers\Buyer\BuyerController::class, 
    ['only' => ['index', 'show']]);
Route::apiResource('buyers.transactions', \App\Http\Controllers\Buyer\BuyerTransactionController::class, 
    ['only' => 'index']);
Route::apiResource('buyers.products', \App\Http\Controllers\Buyer\BuyerProductController::class, 
    ['only' => 'index']);
Route::apiResource('buyers.sellers', \App\Http\Controllers\Buyer\BuyerSellerController::class, 
    ['only' => 'index']);
Route::apiResource('buyers.categories', \App\Http\Controllers\Buyer\BuyerCategoryController::class, 
    ['only' => 'index']);
/**
 * Categories
 */
Route::apiResource('categories', \App\Http\Controllers\Category\CategoryController::class, 
    ['except' => 'create', 'edit']);
Route::apiResource('categories.products', \App\Http\Controllers\Category\CategoryProductController::class, 
    ['only' => 'index']);
Route::apiResource('categories.sellers', \App\Http\Controllers\Category\CategorySellerController::class, 
    ['only' => 'index']);
Route::apiResource('categories.transactions', \App\Http\Controllers\Category\CategoryTransactionController::class, 
    ['only' => 'index']);
Route::apiResource('categories.buyers', \App\Http\Controllers\Category\CategoryBuyerController::class, 
    ['only' => 'index']);
/**
 * Products
 */
Route::apiResource('products', \App\Http\Controllers\Product\ProductController::class, 
    ['only' => ['index', 'show']]);
Route::apiResource('products.transactions', \App\Http\Controllers\Product\ProductTransactionController::class, 
    ['only' => 'index']);
Route::apiResource('products.buyers', \App\Http\Controllers\Product\ProductBuyerController::class, 
    ['only' => 'index']);
Route::apiResource('products.categories', \App\Http\Controllers\Product\ProductCategoryController::class, 
    ['only' => 'index', 'update', 'destroy']);
Route::apiResource('products.buyers.transactions', \App\Http\Controllers\Product\ProductBuyerTransactionController::class, 
    ['only' => 'store']);
/**
 * Sellers
 */
Route::apiResource('sellers', \App\Http\Controllers\Seller\SellerController::class, 
    ['only' => ['index', 'show']]);
Route::apiResource('sellers.transactions', \App\Http\Controllers\Seller\SellerTransactionController::class, 
    ['only' => 'index']);
Route::apiResource('sellers.categories', \App\Http\Controllers\Seller\SellerCategoryController::class, 
    ['only' => 'index']);
Route::apiResource('sellers.buyers', \App\Http\Controllers\Seller\SellerBuyerController::class, 
    ['only' => 'index']);
Route::apiResource('sellers.products', \App\Http\Controllers\Seller\SellerProductController::class, 
    ['except' => 'edit', 'create', 'show']);
/**
 * Transactions
 */
Route::apiResource('transactions', \App\Http\Controllers\Transaction\TransactionController::class, 
    ['only' => ['index', 'show']]);
Route::apiResource('transactions.categories', \App\Http\Controllers\Transaction\TransactionCategoryController::class, 
    ['only' => 'index']);
Route::apiResource('transactions.sellers', \App\Http\Controllers\Transaction\TransactionCategoryController::class, 
    ['only' => 'index']);

/**
 * Users
 */
Route::apiResource('users', \App\Http\Controllers\User\UserController::class, 
    ['except' => 'create', 'edit']);
Route::name('verify')->get('users/verify/{token}', [\App\Http\Controllers\User\UserController::class, 'verify']);
Route::name('verify')->get('users/{user}/resend', [\App\Http\Controllers\User\UserController::class, 'resend']);

Route::post('oauth/token',[\Laravel\Passport\Http\Controllers\AccessTokenController::class,'issueToken'] );