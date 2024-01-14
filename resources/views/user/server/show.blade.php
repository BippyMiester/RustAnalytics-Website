@extends('layouts.dashboard')

@section('title', $server->name)

@section('content')

    <h1>{{ $server->name }}</h1>

    @include('user.server.modules.panels')

    <hr>

    @include('user.server.modules.verticalTabs')


@endsection
