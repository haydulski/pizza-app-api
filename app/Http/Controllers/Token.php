<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Vinkla\Hashids\Facades\Hashids;

class Token extends Controller
{
    public function __invoke(string $id, Request $request)
    {
        // $decodeId = Hashids::decode($id);

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $user = User::find($id);
        $user->tokens()->delete();
        $token = $user->createToken('api')->plainTextToken;

        return response()->json($token);
    }
}
