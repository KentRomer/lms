@extends('layouts.app')

@section('title', 'Instructor Dashboard - LearnHub')

@section('content')
<div class="container">

    @if(session('success'))
    <div style="color: green; margin-bottom: 15px;">
        {{ session('success') }}
    </div>
@endif

    <h1>Instructor Dashboard</h1>
    <p>Welcome, {{ auth()->user()->name }}!</p>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn">Logout</button>
    </form>
</div>
@endsection
