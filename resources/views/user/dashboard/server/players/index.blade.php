@extends('layouts.dashboard2')

@section('title', $server->name . ' - Players')

@section('breadcrumbs')
    <li class="breadcrumb-item">Servers</li>
    <li class="breadcrumb-item"><a href="{{ route('user.dashboard.server.show', $server->slug) }}">{{ \Illuminate\Support\Str::limit($server->name, 30) }}</a></li>
    <li class="breadcrumb-item active">Players</li>
@endsection

@section('content')

    <div class="row">
        @foreach($players as $player)
            <div class="col-sm-2">
                <div class="card mb-3">
                    <!-- BEGIN card-body -->
                    <div class="card-body">
                        <!-- BEGIN title -->
                        <div class="d-flex fw-bold mb-3">
                            <h5 class="flex-grow-1">{{ $player->username }}</h5>
                            {{--                        <a href="#" data-toggle="card-expand" class="text-inverse text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>--}}
                        </div>
                        <!-- END title -->
                        <!-- BEGIN stat-lg -->
                        <div class="row align-items-center mb-2">
                            <div class="col-12">
                                <p>
                                    SteamID: {{ $player->steam_id }} <br>
                                    Last IP: {{ $player->ip_address }}
                                </p>
                                <a href="{{ route('user.dashboard.server.players.show', [$server->slug, $player->steam_id]) }}" class="btn btn-sm btn-primary">View</a>
                            </div>
                        </div>
                        <!-- END stat-lg -->
                    </div>
                    <!-- END card-body -->

                    <!-- BEGIN card-arrow -->
                    <div class="card-arrow">
                        <div class="card-arrow-top-left"></div>
                        <div class="card-arrow-top-right"></div>
                        <div class="card-arrow-bottom-left"></div>
                        <div class="card-arrow-bottom-right"></div>
                    </div>
                    <!-- END card-arrow -->
                </div>
            </div>
        @endforeach
        <div class="d-flex justify-content-center">
            <!-- Pagination Links -->
            {{ $players->links('pagination::bootstrap-4') }}
        </div>
    </div>

@endsection
