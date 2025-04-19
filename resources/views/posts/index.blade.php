@extends('layouts.master')

@section('title', 'All Posts')

@section('content')
    <h1 class="text-center">Welcome to the Blog</h1>
    <p class="text-center">Explore posts and share your thoughts!</p>

    <div class="row g-4">
        @forelse ($posts_arr as $post)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 shadow-sm">
                    {{-- Image Preview --}}
                    <img src="{{ asset( 'images/' . ($post['image']['path'] ?? 'default.png')) }}"
                         class="card-img-top" alt="{{ $post['title'] }}"
                         style="height: 200px; object-fit: cover;">

                    <div class="card-body">
                        <h5 class="card-title">{{ $post['title'] }}</h5>
                        <p class="card-text">{{ Str::limit($post['content'], 120) }}</p>
                        <p class="card-text text-muted">
                            <small>By {{ $post['writer'] ?? 'Unknown' }} • {{ $post['created_at'] }}</small>
                        </p>
                        <a href="{{ route('posts.show', $post['id']) }}" class="btn btn-sm btn-outline-primary">Read More</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted text-center">No blog posts found.</p>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $posts->links() }}
    </div>
@endsection
