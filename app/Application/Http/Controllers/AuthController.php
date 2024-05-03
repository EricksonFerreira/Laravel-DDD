<?php
namespace App\Application\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\User\Services\AuthService;
use App\Application\Http\Controllers\Controller;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(Request $request)
    {
        $token = $this->authService->login($request->only('email', 'password'));

        return response()->json(['access_token' => $token, 'token_type' => 'Bearer']);
    }

    public function logout(Request $request)
    {
        $this->authService->logout($request->user());

        return response()->json(['message' => 'Logged out']);
    }
}
