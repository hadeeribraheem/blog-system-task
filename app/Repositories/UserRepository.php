<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function saveUser(array $data, $id = null)
    {
        return User::updateOrCreate(
            ['id' => $id],
            $data
        );
    }
}
