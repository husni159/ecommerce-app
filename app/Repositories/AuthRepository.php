<?php
// app/Repositories/ProductRepository.php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthRepository
{
   public function createUser(Request $request) {
    User::create([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => Hash::make($request->input('password')),
        'type' => $request->input('type'),
    ]);
   }
}
