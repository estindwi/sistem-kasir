<?php

namespace App\Repositories\RepositoryInterface;

interface UserRepositoryInterface
{
    public function all();

    public function find($id);

    public function findByUsername($username);

    public function create(array $data);

    public function update($id, array $data);
}