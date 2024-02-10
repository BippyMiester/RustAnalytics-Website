@extends('layouts.dashboard2')

@section('title', 'API Keys')

@section('breadcrumbs')
    <li class="breadcrumb-item">Servers</li>
    <li class="breadcrumb-item active">API Keys</li>
@endsection

@section('content')

    <div class="row justify-content-center">
        <div class="col-sm-4">
            @foreach($servers as $server)
                <h1>{{ \Illuminate\Support\Str::limit($server->name, 30) }}</h1>
                <p>API Key</p>
                <pre>{{ $server->api_key }}</pre>
                <a href="{{ route('user.dashboard.server.show', $server->slug) }}" class="btn btn-primary">View Server</a>
            @endforeach
        </div>
    </div>

@endsection
