@extends('layouts.master')

@section('title', $resource['title'])

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- post card -->
                <div class="card border-0 shadow-lg overflow-hidden">

                    <!-- post img -->
                    <div class="bg-image">
                        <img src="{{ asset('images/' . ($resource['image']['path'] ?? 'default.png')) }}"
                             class="w-100 img-fluid"
                             alt="Post Image"
                             style="max-height: 450px; object-fit: cover;">
                    </div>

                    <!-- post content -->
                    <div class="card-body p-4">
                        <!-- title -->
                        <h1 class="fw-bold mb-3" style="color: #21466c">{{ $resource['title'] }}</h1>

                        <!-- writer and created date -->
                        <div class="text-muted mb-4">
                            <i class="bi bi-person-circle me-1"></i>
                            <span class="fw-bold" style="color: #2E5077">{{ $resource['writer'] ?? 'Anonymous' }}</span>
                            <span class="m-2">•</span>
                            {{ $resource['created_at'] }}

                            <!-- show updated date -->
                            @if($resource['updated_at'])
                                <span class="m-2 text-muted">(Updated {{ $resource['updated_at'] }})</span>
                            @endif
                        </div>

                        <!-- content -->
                        <p class="lead" >{{ $resource['content'] }}</p>

                        <!-- actions buttons -->
                        <div class="mt-4 d-flex justify-content-between">
                            <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left"></i> Back to All Posts
                            </a>

                            <!-- Edit/Delete (if user is authorized) -->
                            @can('update', $post)
                                <div>
                                    <a href="{{ route('posts.edit', $resource['id']) }}" class="btn btn-outline-primary me-2">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>

                                    <form action="{{ route('posts.destroy', $resource['id']) }}" method="POST" class="d-inline"
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
