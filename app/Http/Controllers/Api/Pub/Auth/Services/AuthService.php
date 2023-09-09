<?php

namespace App\Http\Controllers\Api\Pub\Auth\Services;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pub\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthService extends Controller
{
    public function createUser(RegisterRequest $request): void
    {
        User::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
        ]);
    }
}
