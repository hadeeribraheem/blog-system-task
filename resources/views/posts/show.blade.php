@extends('layouts.master')

@section('title', $post->title)

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-lg overflow-hidden">
                    @if($post->image)
                        <div class="bg-image">
                            <img src="{{ asset('images/' . $post->image->path) }}"
                                 class="w-100 img-fluid"
                                 alt="{{ $post->title }}"
                                 style="max-height: 450px; object-fit: cover;">
                        </div>
                    @else
                        <div class="bg-image">
                            <img src="{{ asset('images/default.png') }}"
                                 class="w-100 img-fluid"
                                 alt="Default Image"
                                 style="max-height: 450px; object-fit: cover;">
                        </div>
                    @endif

                    <div class="card-body p-4">
                        <h1 class="fw-bold mb-3">{{ $post->title }}</h1>
                        <div class="text-muted mb-4">
                            <i class="bi bi-person-circle me-2"></i>
                            {{ $post->user->name ?? 'Anonymous' }}
                            <span class="mx-2">•</span>
                            {{ $post->created_at->format('F d, Y') }}
                            @if($post->updated_at)
                                <span class="mx-2 text-muted">(Updated {{ $post->updated_at->diffForHumans() }})</span>
                            @endif
                        </div>

                        <p class="lead" style="line-height: 1.7;">{{ $post->content }}</p>

                        <div class="mt-4 d-flex justify-content-between">
                            <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left"></i> Back to All Posts
                            </a>

                            @can('update', $post)
                                <div>
                                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-outline-primary me-2">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>

                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this post?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
