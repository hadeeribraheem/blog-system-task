<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Support\Facades\DB;

class PostRepository implements PostRepositoryInterface
{
    public function findById($id)
    {
        return Post::with('image')->find($id);
    }
    public function savePost(array $data, $id = null)
    {
        return Post::updateOrCreate(
            ['id' => $id],
            $data
        );
    }
}
