<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('hello');
});

require __DIR__ . '/auth.php';
