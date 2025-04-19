@extends('layouts.master')

@section('title', 'Login')

@section('content')
    <div class="d-flex flex-column min-vh-100 position-relative">
        <div class="container d-flex justify-content-center align-items-center flex-grow-1">
            <div class="card p-4 shadow-sm border-0" style="max-width: 500px; width: 100%;">
                <h3 class="text-center mb-4 fw-bold">Login to Your Account</h3>

                <form method="POST" action="{{ route('login.submit') }}">
                    @csrf

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               name="email" id="email" value="{{ old('email') }}" required autofocus>
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
                        <button type="submit" class="btn btn-primary fw-semibold shadow-sm">Login</button>
                    </div>

                    {{-- Register link --}}
                    <div class="text-center mt-3">
                        Don't have an account? <a href="{{ route('register') }}"><strong>Register</strong></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
