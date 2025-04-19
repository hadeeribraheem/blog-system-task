<?php

namespace App\Repositories;

interface PostRepositoryInterface
{

    public function findById($id);

    public function savePost(array $data , $id = null);
}
