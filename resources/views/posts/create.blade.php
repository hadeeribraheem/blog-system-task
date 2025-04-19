@extends('layouts.master')

@section('title', 'Create New Post')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-sm border-0" style="max-width: 700px; margin: auto;">
            <div class="card-header text-white">
                <h5 class="mb-0"><i class="bi bi-vector-pen me-2"></i>Create New Post</h5>
            </div>

            <div class="card-body">
                <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- Title --}}
                    <div class="mb-3">
                        <label for="title" class="form-label">Post Title</label>
                        <input type="text" name="title" id="title"
                               class="form-control @error('title') is-invalid @enderror"
                               value="{{ old('title') }}" placeholder="Enter post title" required>
                        @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Content --}}
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea name="content" id="content" rows="6"
                                  class="form-control @error('content') is-invalid @enderror"
                                  placeholder="Write your post..." required>{{ old('content') }}</textarea>
                        @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Image --}}
                    <div class="mb-3">
                        <label for="image" class="form-label">Upload Image (optional)</label>
                        <input type="file" name="image" id="image"
                               class="form-control @error('image') is-invalid @enderror"
                               accept="image/*">
                        @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Submit --}}
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('home') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="text-white btn save-post">Publish</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
