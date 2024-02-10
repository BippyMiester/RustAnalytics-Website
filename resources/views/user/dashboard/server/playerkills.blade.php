@extends('layouts.dashboard2')

@section('title', $server->name . ' - Player Kills')

@section('breadcrumbs')
    <li class="breadcrumb-item">Servers</li>
    <li class="breadcrumb-item"><a href="{{ route('user.dashboard.server.show', $server->slug) }}">{{ \Illuminate\Support\Str::limit($server->name, 30) }}</a></li>
    <li class="breadcrumb-item active">Player Kills</li>
@endsection

@section('content')

    <!-- Begin Cards Row -->
    <div class="row">
        <div class="col-sm-3">
            <div class="card mb-3">
                <!-- BEGIN card-body -->
                <div class="card-body">
                    <!-- BEGIN title -->
                    <div class="d-flex fw-bold mb-3">
                        <span class="flex-grow-1">Top Kills</span>
                        {{--                        <a href="#" data-toggle="card-expand" class="text-inverse text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>--}}
                    </div>
                    <!-- END title -->
                    <!-- BEGIN stat-lg -->
                    <div class="row align-items-center mb-2">
                        <div class="col-12">
                            <p>
                                @foreach ($topPlayerKills as $player)
                                    <strong>{{ $player['username'] }}</strong> - {{ $player['kill_count'] }} <br>
                                @endforeach
                            </p>
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
        <div class="col-sm-3">
            <div class="card mb-3">
                <!-- BEGIN card-body -->
                <div class="card-body">
                    <!-- BEGIN title -->
                    <div class="d-flex fw-bold mb-3">
                        <span class="flex-grow-1">Top Weapons Used</span>
                        {{--                        <a href="#" data-toggle="card-expand" class="text-inverse text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>--}}
                    </div>
                    <!-- END title -->
                    <!-- BEGIN stat-lg -->
                    <div class="row align-items-center mb-2">
                        <div class="col-12">
                            <p>
                                @foreach ($topPlayerKillsWeapons as $weapon)
                                    <strong>{{ $weapon['weapon'] }}</strong> - {{ $weapon['count'] }} <br>
                                @endforeach
                            </p>
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
        <div class="col-sm-3">
            <div class="card mb-3">
                <!-- BEGIN card-body -->
                <div class="card-body">
                    <!-- BEGIN title -->
                    <div class="d-flex fw-bold mb-3">
                        <span class="flex-grow-1">Top 10 Longest Distances</span>
                        {{--                        <a href="#" data-toggle="card-expand" class="text-inverse text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>--}}
                    </div>
                    <!-- END title -->
                    <!-- BEGIN stat-lg -->
                    <div class="row align-items-center mb-2">
                        <div class="col-12">
                            <p>
                                @foreach ($topPlayerKillDistances as $kill)
                                    <strong>{{ $kill['username'] }}</strong> - {{ $kill['distance'] }} meters <br>
                                @endforeach
                            </p>
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
    <div class="row">
        <div class="col-sm-12">
            <table class="table table-sm table-hover table-borderless">
                <thead>
                <tr>
                    <th>Kill ID</th>
                    <th>Killer Steam ID</th>
                    <th>Killer</th>
                    <th>Victim</th>
                    <th>Weapon</th>
                    <th>Body Part</th>
                    <th>Distance</th>
                    <th>Time</th>
                </tr>
                </thead>
                <tbody>
                @foreach($playerKills as $kill)
                    <tr>
                        <th>{{ $kill->kill_id }}</th>
                        <th>
                            <a href="https://www.steamidfinder.com/lookup/{{ $kill->steam_id }}/" target="_blank"><strong>{{ $kill->steam_id }}</strong></a>
                        </th>
                        <td>{{ $kill->username }}</td>
                        <td>{{ $kill->victim }}</td>
                        <td>{{ $kill->weapon }}</td>
                        <td>{{ $kill->body_part }}</td>
                        <td>{{ $kill->distance }} m</td>
                        <td>{{ $kill->created_at->format('H:i:s | m-d-y') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                <!-- Pagination Links -->
                {{ $playerKills->links('pagination::bootstrap-4') }}
            </div>
        </div>

    </div>
    <!-- End Data Cards -->
@endsection
