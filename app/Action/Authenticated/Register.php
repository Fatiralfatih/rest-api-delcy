<?php

namespace App\Action\Authenticated;

use App\Http\Requests\RegisterRequest;
use App\Models\User;

class Register
{
    function execute(RegisterRequest $request): User
    {
        $user = User::create([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return $user;
    }
}