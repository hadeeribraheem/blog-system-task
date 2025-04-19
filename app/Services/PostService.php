<?php

namespace App\Services;

use App\Models\Post;
use App\Repositories\PostRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class PostService
{
    protected PostRepositoryInterface $postRepo;
    protected ImageService $imageService;

    public function __construct(PostRepositoryInterface $postRepo, ImageService $imageService)
    {
        $this->postRepo = $postRepo;
        $this->imageService = $imageService;
    }

    /**
     * Store a new post with optional image.
     */
    public function storePost(array $data, $file = null): Post
    {
        return DB::transaction(function () use ($data, $file) {
            $data['user_id'] = auth()->id();

            $post = $this->postRepo->savePost($data);

            if ($file) {
                $imagePath = $this->imageService->upload($file, 'posts');
                $post->image()->create(['path' => $imagePath]);
            }

            return $post;
        });
    }

    /**
     * Update an existing post with optional image replacement.
     */
    public function updatePost(array $data, int $id, $file = null): Post
    {
        return DB::transaction(function () use ($data, $id, $file) {
            $post = $this->postRepo->findById($id);

            Gate::authorize('update', $post);

            $post = $this->postRepo->savePost($data, $id);

            if ($file) {
                if ($post->image) {
                    $this->imageService->deleteOldImage($post);
                    $post->image->delete();

                }

                $imagePath = $this->imageService->upload($file, 'posts');
                $post->image()->create(['path' => $imagePath]);
            }

            return $post;
        });
    }
    public function deletePost(Post $post)
    {
        return DB::transaction(function () use ($post) {
            if ($post->image) {
                $this->imageService->deleteOldImage($post);
            }

            $post->delete();
        });
    }
}
