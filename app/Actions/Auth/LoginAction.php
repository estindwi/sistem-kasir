<?php

namespace App\Actions\Auth;

use App\Repositories\RepositoryInterface\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginAction
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(string $username, string $password): bool
    {
        $user = $this->userRepository->findByUsername($username);

        if (!$user) {
            return false;
        }

        if (!Hash::check($password, $user->password)) {
            return false;
        }

        Auth::login($user);

        return true;
    }
}