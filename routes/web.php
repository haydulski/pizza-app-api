<?php

use App\Http\Controllers\SecretController;
use App\Http\Controllers\Token;
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

Route::get('/', function () {
    return view('hello');
});

Route::get('/test/{id}', Token::class);

Route::middleware('auth:sanctum')->get('/test-2', SecretController::class);

require __DIR__.'/auth.php';
