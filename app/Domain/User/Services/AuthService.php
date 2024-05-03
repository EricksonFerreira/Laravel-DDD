<?php
namespace App\Domain\User\Services;

use App\Application\Exceptions\ValidationException;
use Illuminate\Support\Facades\Auth;
use App\Domain\User\Repositories\UserRepositoryInterface;

class AuthService
{
    private $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function login(array $credentials)
    {
        if (!Auth::attempt($credentials)) {
            throw new ValidationException(['user' => ['Invalid credentials']]);
        }

        $user = $this->repository->findByEmail($credentials['email']);
        $token = $user->createToken('authToken')->plainTextToken;

        return $token;
    }

    public function logout($user)
    {
        $user->currentAccessToken()->delete();
    }
}
