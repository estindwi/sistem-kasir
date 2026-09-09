<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\RepositoryInterface\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function findByUsername($username)
    {
        return $this->model
            ->where('username', $username)
            ->first();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $user = $this->model->find($id);

        if (!$user) {
            return null;
        }

        $user->update($data);

        return $user;
    }
}