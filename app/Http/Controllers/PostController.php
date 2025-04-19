<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Services\PostService;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;

        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $posts = Post::latest()->with(['user', 'image'])->paginate(12);
        $posts_arr = PostResource::collection($posts)->resolve();

        return view('posts.index', compact('posts_arr', 'posts'));
    }

    public function dashboard()
    {
        $posts = auth()->user()->posts()->latest()->get();
        $posts_arr = PostResource::collection($posts)->resolve();
        return view('posts.dashboard', compact('posts_arr'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(StorePostRequest $request)
    {
        $data = $request->validated();
        $file = $request->file('image');

        $this->postService->storePost($data, $file);
        Flasher::addSuccess('Post created successfully');
        return redirect()->route('dashboard');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return view('posts.edit', compact('post'));
    }

    public function update(StorePostRequest $request, Post $post)
    {
        $this->authorize('update', $post);

        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $file = $request->file('image');

        $this->postService->updatePost($data, $post->id, $file);
        Flasher::addSuccess('Post updated successfully');
        return redirect()->route('dashboard');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $this->postService->deletePost($post);
        Flasher::addSuccess('Post deleted successfully');
        return redirect()->route('dashboard');
    }
}
