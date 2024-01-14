@extends('layouts.dashboard')

@section('title', '404 Not Found')

@section('content')
    <div class="error-page">
        <h2>404</h2>
        <p>Sorry, the page you are looking for could not be found.</p>
        <a href="{{ route('user.dashboard') }}">Go Back</a>
    </div>
@endsection
