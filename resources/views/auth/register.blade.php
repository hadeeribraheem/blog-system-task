@extends('layouts.master')

@section('title', 'Register')

@section('content')
    <div class="d-flex flex-column min-vh-100 position-relative">
        <div class="container d-flex justify-content-center align-items-center flex-grow-1">
            <div class="card p-4 shadow-sm border-0" style="max-width: 500px; width: 100%;">
                <h3 class="text-center mb-4 fw-bold">Create an Account</h3>

                <form method="POST" action="{{ route('register.submit') }}">
                    @csrf

                    {{-- Name --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               name="name" id="name" value="{{ old('name') }}" required>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               name="email" id="email" value="{{ old('email') }}" required>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               name="password" id="password" required>
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Submit --}}
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary fw-semibold shadow-sm">Register</button>
                    </div>

                    {{-- Login link --}}
                    <div class="text-center mt-3">
                        Already have an account? <a href="{{ route('login') }}"><strong>Login</strong></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
