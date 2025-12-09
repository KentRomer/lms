@extends('layouts.app')

@section('title', 'Student Dashboard - LearnHub')

@section('content')
<div class="container">
    @if(session('success'))
        <div style="
            padding: 10px;
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
            margin-bottom: 15px;
        ">
            {{ session('success') }}
        </div>
    @endif

    <h1>Student Dashboard</h1>
    <p>Welcome, {{ auth()->user()->name }}!</p>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn">Logout</button>
    </form>
</div>
@endsection