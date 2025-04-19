@extends('layouts.master')

@section('title', 'Edit Post')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm p-4">
            <h2 class="mb-4 text-center">Edit Post</h2>

            <form method="POST" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Title --}}
                <div class="mb-3">
                    <label for="title" class="form-label">Post Title</label>
                    <input type="text" name="title" id="title"
                           class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title', $post->title) }}" required>
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Content --}}
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea name="content" id="content" rows="5"
                              class="form-control @error('content') is-invalid @enderror"
                              required>{{ old('content', $post->content) }}</textarea>
                    @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Image --}}
                <div class="mb-3">
                    <label for="image" class="form-label">Upload New Image (optional)</label>
                    <input type="file" name="image" id="image"
                           class="form-control @error('image') is-invalid @enderror">
                    @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                @if($post->image)
                    <div class="mb-3">
                        <label class="form-label">Current Image:</label><br>
                        <img src="{{ asset('images/' . $post->image->path) }}" width="200" class="img-thumbnail" alt="Post Image">
                    </div>
                @endif

                <button type="submit" class="btn btn-success w-100">Update Post</button>
            </form>
        </div>
    </div>
@endsection
