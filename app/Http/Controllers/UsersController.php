<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{
    public function store(UserRequest $req): Response
    {
        $data = $req->validated();

        if (!isset($data)) {
            return response(401)->json(['errors' => 'validation error']);
        }
        $data['password'] = Hash::make($data['password']);
        $newUser = User::create($data);
        Auth::login($newUser);

        return response()->json($newUser->createToken('api')->plainTextToken);
    }
}
