<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function saveUser(array $data, $id = null);
}
