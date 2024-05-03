<?php
namespace App\Domain\User\Repositories;

use App\Domain\User\Entities\User;

class UserRepository implements UserRepositoryInterface
{
    private $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }
    public function findByEmail($email): User
    {
        return $this->model->where('email', $email)->first();
    }
}
