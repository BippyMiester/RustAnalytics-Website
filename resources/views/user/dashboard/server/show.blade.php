@extends('layouts.dashboard2')

@section('title', $server->name)

@section('breadcrumbs')
    <li class="breadcrumb-item">Servers</li>
    <li class="breadcrumb-item active">{{ \Illuminate\Support\Str::limit($server->name, 30) }}</li>
@endsection

@section('content')

    <!-- Begin Cards Row -->
    <div class="row">
        <div class="col-sm-3">
            <div class="card mb-3">
                <!-- BEGIN card-body -->
                <div class="card-body">
                    <!-- BEGIN title -->
                    <div class="d-flex fw-bold small mb-3">
                        <span class="flex-grow-1"><i class="fa-solid fa-users"></i> Total Number Of Players</span>
                        <a href="#" data-toggle="card-expand" class="text-inverse text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
                    </div>
                    <!-- END title -->
                    <!-- BEGIN stat-lg -->
                    <div class="row align-items-center mb-2">
                        <div class="col-12">
                            <h3 class="mb-0">{{ $uniquePlayerCount }} Players</h3>
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
    </div>
    <!-- End Cards Row -->

    <!-- Start Data Cards -->
    <div class="row justify-content-center">
        <div class="col-sm-3">
            <div class="card mb-3">
                <div class="card-body pb-0 text-center">
                    <img src="{{ asset('imgs/dashboard2/icons/animal_kills.png') }}" alt="" class="card-img-top w-50">
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title">Animal Kills</h5>
                    <a href="{{ route('user.dashboard.server.animalkills', $server->slug) }}" class="btn btn-primary">View</a>
                </div>
                <div class="card-arrow">
                    <div class="card-arrow-top-left"></div>
                    <div class="card-arrow-top-right"></div>
                    <div class="card-arrow-bottom-left"></div>
                    <div class="card-arrow-bottom-right"></div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card mb-3">
                <div class="card-body pb-0 text-center">
                    <img src="{{ asset('imgs/dashboard2/icons/destroyed_containers.png') }}" alt="" class="card-img-top w-50">
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title">Destroyed Containers</h5>
                    <a href="{{ route('user.dashboard.server.destroyedcontainers', $server->slug) }}" class="btn btn-primary">View</a>
                </div>
                <div class="card-arrow">
                    <div class="card-arrow-top-left"></div>
                    <div class="card-arrow-top-right"></div>
                    <div class="card-arrow-bottom-left"></div>
                    <div class="card-arrow-bottom-right"></div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card mb-3">
                <div class="card-body pb-0 text-center">
                    <img src="{{ asset('imgs/dashboard2/icons/destroyed_structures.png') }}" alt="" class="card-img-top w-50">
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title">Destroyed Structures</h5>
                    <a href="{{ route('user.dashboard.server.destroyedstructures', $server->slug) }}" class="btn btn-primary">View</a>
                </div>
                <div class="card-arrow">
                    <div class="card-arrow-top-left"></div>
                    <div class="card-arrow-top-right"></div>
                    <div class="card-arrow-bottom-left"></div>
                    <div class="card-arrow-bottom-right"></div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card mb-3">
                <div class="card-body pb-0 text-center">
                    <img src="{{ asset('imgs/dashboard2/icons/placed_deployables.png') }}" alt="" class="card-img-top w-50">
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title">Placed Deployables</h5>
                    <a href="{{ route('user.dashboard.server.placeddeployables', $server->slug) }}" class="btn btn-primary">View</a>
                </div>
                <div class="card-arrow">
                    <div class="card-arrow-top-left"></div>
                    <div class="card-arrow-top-right"></div>
                    <div class="card-arrow-bottom-left"></div>
                    <div class="card-arrow-bottom-right"></div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card mb-3">
                <div class="card-body pb-0 text-center">
                    <img src="{{ asset('imgs/dashboard2/icons/placed_structures.png') }}" alt="" class="card-img-top w-50">
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title">Placed Structures</h5>
                    <a href="{{ route('user.dashboard.server.placedstructures', $server->slug) }}" class="btn btn-primary">View</a>
                </div>
                <div class="card-arrow">
                    <div class="card-arrow-top-left"></div>
                    <div class="card-arrow-top-right"></div>
                    <div class="card-arrow-bottom-left"></div>
                    <div class="card-arrow-bottom-right"></div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card mb-3">
                <div class="card-body pb-0 text-center">
                    <img src="{{ asset('imgs/dashboard2/icons/player_bans.png') }}" alt="" class="card-img-top w-50">
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title">Player Bans</h5>
                    <a href="#" class="btn btn-secondary">Coming Soon</a>
                </div>
                <div class="card-arrow">
                    <div class="card-arrow-top-left"></div>
                    <div class="card-arrow-top-right"></div>
                    <div class="card-arrow-bottom-left"></div>
                    <div class="card-arrow-bottom-right"></div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card mb-3">
                <div class="card-body pb-0 text-center">
                    <img src="{{ asset('imgs/dashboard2/icons/player_connections.png') }}" alt="" class="card-img-top w-50">
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title">Player Connections</h5>
                    <a href="{{ route('user.dashboard.server.playerconnections', $server->slug) }}" class="btn btn-primary">View</a>
                </div>
                <div class="card-arrow">
                    <div class="card-arrow-top-left"></div>
                    <div class="card-arrow-top-right"></div>
                    <div class="card-arrow-bottom-left"></div>
                    <div class="card-arrow-bottom-right"></div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card mb-3">
                <div class="card-body pb-0 text-center">
                    <img src="{{ asset('imgs/dashboard2/icons/player_crafting.png') }}" alt="" class="card-img-top w-50">
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title">Player Crafting</h5>
                    <a href="{{ route('user.dashboard.server.playercrafting', $server->slug) }}" class="btn btn-primary">View</a>
                </div>
                <div class="card-arrow">
                    <div class="card-arrow-top-left"></div>
                    <div class="card-arrow-top-right"></div>
                    <div class="card-arrow-bottom-left"></div>
                    <div class="card-arrow-bottom-right"></div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card mb-3">
                <div class="card-body pb-0 text-center">
                    <img src="{{ asset('imgs/dashboard2/icons/player_deaths.png') }}" alt="" class="card-img-top w-50">
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title">Player Deaths</h5>
                    <a href="{{ route('user.dashboard.server.playerdeaths', $server->slug) }}" class="btn btn-primary">View</a>
                </div>
                <div class="card-arrow">
                    <div class="card-arrow-top-left"></div>
                    <div class="card-arrow-top-right"></div>
                    <div class="card-arrow-bottom-left"></div>
                    <div class="card-arrow-bottom-right"></div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card mb-3">
                <div class="card-body pb-0 text-center">
                    <img src="{{ asset('imgs/dashboard2/icons/player_gathering.png') }}" alt="" class="card-img-top w-50">
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title">Player Gathering</h5>
                    <a href="#" class="btn btn-secondary">Coming Soon</a>
                </div>
                <div class="card-arrow">
                    <div class="card-arrow-top-left"></div>
                    <div class="card-arrow-top-right"></div>
                    <div class="card-arrow-bottom-left"></div>
                    <div class="card-arrow-bottom-right"></div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card mb-3">
                <div class="card-body pb-0 text-center">
                    <img src="{{ asset('imgs/dashboard2/icons/player_kills.png') }}" alt="" class="card-img-top w-50">
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title">Player Kills</h5>
                    <a href="{{ route('user.dashboard.server.playerkills', $server->slug) }}" class="btn btn-primary">View</a>
                </div>
                <div class="card-arrow">
                    <div class="card-arrow-top-left"></div>
                    <div class="card-arrow-top-right"></div>
                    <div class="card-arrow-bottom-left"></div>
                    <div class="card-arrow-bottom-right"></div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card mb-3">
                <div class="card-body pb-0 text-center">
                    <img src="{{ asset('imgs/dashboard2/icons/weapon_fire.png') }}" alt="" class="card-img-top w-50">
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title">Weapon Fire</h5>
                    <a href="{{ route('user.dashboard.server.weaponfire', $server->slug) }}" class="btn btn-primary">View</a>
                </div>
                <div class="card-arrow">
                    <div class="card-arrow-top-left"></div>
                    <div class="card-arrow-top-right"></div>
                    <div class="card-arrow-bottom-left"></div>
                    <div class="card-arrow-bottom-right"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Data Cards -->
@endsection
