@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="card mt-4">
    <div class="card-header">
        Welcome to the Admin Dashboard
    </div>
    <div class="card-body">
        <h5 class="card-title">Hello, {{ Auth::guard('admin')->user()->name }}!</h5>
        <p class="card-text">We're glad to have you back. Use the navigation on the left to manage your application and view important information.</p>
        <a href="{{ route('admin.users') }}" class="btn btn-primary">View All Users</a>
    </div>
</div>

<!-- Optional: Add more sections or widgets as needed -->

@endsection
