@extends('layouts.dashboard')

@section('title', $server->name)

@section('stylesheets')
    <style>
        .copyCoordinates:hover {
            cursor: pointer;
        }
    </style>
@endsection

@section('content')

    <h1>{{ $server->name }}</h1>

    @include('user.server.modules.panels')

    <hr>

    @include('user.server.modules.verticalTabs')

@endsection
