<?php

namespace App\Http\Controllers;

class SecretController extends Controller
{
    public function __invoke()
    {
        return response()->json('Działa');
    }
}
