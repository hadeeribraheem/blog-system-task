@extends('layouts.master')

@section('title', 'Edit Post')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-sm border-0" style="max-width: 700px; margin: auto;">
            <div class="card-header  text-white">
                <h5 class="mb-0"><i class="bi bi-vector-pen me-2"></i>Edit Post</h5>
            </div>

            <div class="card-body">
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
                        <textarea name="content" id="content" rows="6"
                                  class="form-control @error('content') is-invalid @enderror"
                                  required>{{ old('content', $post->content) }}</textarea>
                        @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Image Upload --}}
                    <div class="mb-3">
                        <label for="image" class="form-label">Upload New Image (optional)</label>
                        <input type="file" name="image" id="image"
                               class="form-control @error('image') is-invalid @enderror"
                               accept="image/*">
                        @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Current Image Preview --}}
                    @if($post->image)
                        <div class="mb-3">
                            <label class="form-label">Current Image:</label><br>
                            <img src="{{ asset('images/' . $post->image->path) }}" width="200" class="img-thumbnail" alt="Post Image">
                        </div>
                    @endif

                    {{-- Submit --}}
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn text-white save-post">Update Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
