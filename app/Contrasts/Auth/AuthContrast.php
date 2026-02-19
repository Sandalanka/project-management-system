<?php

namespace App\Contrasts\Auth;

use App\Models\User;
use Illuminate\Http\Request;

interface AuthContrast
{
    public function register(array $data): User;

    public function getUser(array $data): User;

    public function logout(Request $request): void;
}
