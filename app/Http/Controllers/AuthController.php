<?php

use App\Models\User;
use Illuminate\Routing\Controller;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();

        // Encontre ou crie o usuário no banco de dados
        $dbUser = User::firstOrCreate(
            ['email' => $user->email],
            ['name' => $user->name]
        );

        // Atribua roles e permissões ao usuário, se necessário
        $dbUser->assignRole('user');

        // Gere um token de acesso Sanctum
        $token = $dbUser->createToken('flutter-app')->plainTextToken;

        return response()->json(['token' => $token]);
    }
}