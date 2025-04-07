<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('users', [UserController::class, 'index'])->name('users.index');

// Afficher un utilisateur
Route::get('users/{id}', [UserController::class, 'show'])->name('users.show');

// Créer un utilisateur
Route::get('users/create', [UserController::class, 'create'])->name('users.create');
Route::post('users', [UserController::class, 'store'])->name('users.store');

// Modifier un utilisateur
Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('users/{id}', [UserController::class, 'update'])->name('users.update');

// Supprimer un utilisateur
Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
