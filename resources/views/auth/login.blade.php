@extends('layouts.app')

@section('title', 'Welcome Back - LearnHub')

@section('content')
<div class="container">
    <div class="logo">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path d="M12 3L1 9L5 11.18V17.18L12 21L19 17.18V11.18L21 10.09V17H23V9L12 3ZM18.82 9L12 12.72L5.18 9L12 5.28L18.82 9ZM17 15.99L12 18.72L7 15.99V12.27L12 15L17 12.27V15.99Z"/>
        </svg>
    </div>

    <h1>Welcome Back</h1>
    <p class="subtitle">Sign in to your LearnHub account</p>

    @if ($errors->any())
        <div class="error-message">
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif

    @if (session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" required autofocus>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="••••••••" required>
        </div>

        <div class="demo-tip">
            <strong>Demo tip:</strong> Use any email with "instructor" to login as instructor, or any other email for student role.
        </div>

        <button type="submit" class="btn">Sign In</button>

        <div class="footer-link">
            Don't have an account? <a href="{{ route('register') }}">Register</a>
        </div>
    </form>
</div>
@endsection
