@extends('layouts.app')

@section('title', 'Create Account - LearnHub')

@section('content')
<div class="container">
    <h1>Create Account</h1>
    <p class="subtitle">Sign up for LearnHub</p>

    @if ($errors->any())
        <div class="error-message">
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('register.submit') }}">
        @csrf

        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="John Doe" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="••••••••" required>
        </div>

        <div class="form-group">
            <label for="role">Select Role</label>
            <select id="role" name="role" required>
                <option value="student">Student</option>
                <option value="instructor">Instructor</option>
            </select>
        </div>

        <button type="submit" class="btn">Register</button>

        <div class="footer-link">
            Already have an account? <a href="{{ route('login') }}">Login</a>
        </div>
    </form>
</div>
@endsection
