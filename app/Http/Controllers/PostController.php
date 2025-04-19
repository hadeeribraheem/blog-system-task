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

        // apply the middleware  to all except those 2 Fns
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        // load latest posts with ( user & img ) relationships
        $posts = Post::latest()->with(['user', 'image'])->paginate(12);

        // use resource to transform data returned
        $posts_arr = PostResource::collection($posts)->resolve();

        return view('posts.index', compact('posts_arr', 'posts'));
    }


    /**
     * This function to show all posts created by the user logged in
    **/
    public function dashboard()
    {
        $posts = auth()->user()->posts()->with('image')->latest()->get();
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
        $post->load('image');
        $resource = PostResource::make($post)->resolve();
        /*dd($post);*/
        return view('posts.show', compact('post','resource'));
    }

    public function edit(Post $post)
    {
        // Authorize the user LOGGED IN to update post using policy
        $this->authorize('update', $post);

        return view('posts.edit', compact('post'));
    }

    public function update(StorePostRequest $request, Post $post)
    {
        // Authorize the user LOGGED IN to update post using policy
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
        // Authorize the user LOGGED IN to delete post using policy
        $this->authorize('delete', $post);

        $this->postService->deletePost($post);

        Flasher::addSuccess('Post deleted successfully');
        return redirect()->route('dashboard');
    }
}
