<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function create($validateData)
    {
        return User::create([
            'name' => $validateData['name'],
            'email' => $validateData['email'],
            'phone_number' => $validateData['phone_number'],
            'password' => Hash::make($validateData['password']),
        ]);
    }
}
