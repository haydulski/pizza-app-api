<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateReaquest;
use App\Http\Resources\VendorResource;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{
    public function index(): Response
    {
        if (!Gate::allows('admin-check', Auth::user())) {
            return response()->json(['errors' => 'You are not admin'], 403);
        }
        $data = User::where('is_admin', 0)->get();

        return response()->json($data);
    }

    public function store(UserRequest $req): Response
    {
        $count = User::count();
        if ($count > 10) {
            return response()->json('Too many users', 206);
        }

        $data = $req->validated();

        $data['password'] = Hash::make($data['password']);
        $newUser = User::create($data);

        event(new Registered($newUser));

        Auth::login($newUser);

        return response()->json($newUser->createToken('api')->plainTextToken);
    }

    public function update(UserUpdateReaquest $req): Response
    {
        $data = $req->validated();
        $user = User::find(Auth::id());
        $user->update($data);

        return response()->json($data);
    }

    public function vendor(): VendorResource
    {
        $user = User::with('orders')->find(Auth::id());

        return new VendorResource($user);
    }
}
