<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\IngredientController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PizzaController;
use App\Http\Controllers\Api\UsersController as ApiUsersController;
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

Route::prefix('/ingredients')->group(function () {
    Route::get('/', [IngredientController::class, 'index'])->name('api.ingredients.list');
    Route::post('/', [IngredientController::class, 'store'])->name('api.ingredients.add');
    Route::get('/categories', [CategoryController::class, 'index'])->name('api.ingredients.categories');
});

Route::prefix('/pizza')->group(function () {
    Route::get('/', [PizzaController::class, 'index'])->name('api.pizza.list');
    Route::get('/{id}', [PizzaController::class, 'show'])->name('api.pizza.show');
    Route::post('/', [PizzaController::class, 'store'])->name('api.pizza.add');
});

Route::prefix('/order')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('api.order.list');
    Route::post('/', [OrderController::class, 'store'])->name('api.order.add');
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('/user')->group(function () {
        Route::get('/', [ApiUsersController::class, 'vendor'])->name('api.user.vendor');
        Route::get('/all', [ApiUsersController::class, 'index'])->name('api.user.all');
        Route::post('/', [ApiUsersController::class, 'store'])->name('api.user.create');
        Route::post('/update', [ApiUsersController::class, 'update'])->name('api.user.update');
        Route::get('/order/{hashId}', [OrderController::class, 'show'])->name('api.user.single-order');
    });
});
