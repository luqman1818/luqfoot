<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ShirtController;

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


//Route::middleware('auth:sanctum')->group(function () {

Route::get('users', [UserController::class, 'index']);
Route::get('users/{id}', [UserController::class, 'show']);
Route::post('users', [UserController::class, 'store']);
Route::put('users/{id}', [UserController::class, 'update']);
Route::delete('users/{id}', [UserController::class, 'destroy']);


// ✅ Routes API pour les rôles
Route::get('roles', [RoleController::class, 'index']);
Route::get('roles/{id}', [RoleController::class, 'show']);
Route::post('roles', [RoleController::class, 'store']);
Route::put('roles/{id}', [RoleController::class, 'update']);
Route::delete('roles/{id}', [RoleController::class, 'destroy']);


Route::get('orders', [OrderController::class, 'index']);
Route::get('orders/{id}', [OrderController::class, 'show']);
Route::post('orders', [OrderController::class, 'store']);
Route::put('orders/{id}', [OrderController::class, 'update']);
Route::delete('orders/{id}', [OrderController::class, 'destroy']);


// Afficher la liste de toutes les chemises
Route::get('shirts', [ShirtController::class, 'index']);

// Afficher une chemise spécifique
Route::get('shirts/{id}', [ShirtController::class, 'show']);

// Créer une nouvelle chemise
Route::post('shirts', [ShirtController::class, 'store']);

// Modifier une chemise existante
Route::put('shirts/{id}', [ShirtController::class, 'update']);

// Supprimer une chemise
Route::delete('shirts/{id}', [ShirtController::class, 'destroy']);
//});
