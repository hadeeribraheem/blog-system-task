@extends('layouts.master')

@section('title', 'My Dashboard')

@section('content')
    <h2 class="text-center mb-4" id="dashboard-title">My Blog Posts</h2>

    <div class="mb-3 text-end">
        <a href="{{ route('posts.create') }}" class="btn btn-success">+ New Post</a>
    </div>

    @if(count($posts_arr))
        <table id="dashboardTable" class="table table-bordered table-striped">
            <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Title</th>
                <th>Created At</th>
                <th>Last Update</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($posts_arr as $post)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <img src="{{ asset('images/' . ($post['image']['path'] ?? 'default.png')) }}"
                             class="card-img-top img-fluid" alt="{{ $post['title'] }}"
                             style="height: 50px; object-fit: cover;">
                    </td>
                    <td>{{ $post['title'] }}</td>
                    <td>{{ $post['created_at'] }}</td>
                    <td>{{ $post['updated_at'] ?? '-' }}</td>
                    <td>
                        <a href="{{ route('posts.show', $post['id']) }}" class="btn btn-sm btn-info text-white"><i class="bi bi-eye"></i></a>
                        <a href="{{ route('posts.edit', $post['id']) }}" class="btn btn-sm btn-primary"><i class="bi bi-pen"></i></a>
                        <form action="{{ route('posts.destroy', $post['id']) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <div class="d-flex flex-column align-items-center justify-content-center">
            <p class="text-center mt-4 text-muted">No posts to display.</p>
            <img src="{{ asset('empty_dashboard.png') }}" class="w-50 img-fluid" alt="no posts found illustration">
        </div>

    @endif

@endsection

