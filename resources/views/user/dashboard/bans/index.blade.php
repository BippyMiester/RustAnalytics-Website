@extends('layouts.dashboard2')

@section('title', 'Player Bans')

@section('content')

    <!-- Begin Cards Row -->
    <div class="row">
        <div class="col-sm-3">
            <div class="card mb-3">
                <!-- BEGIN card-body -->
                <div class="card-body">
                    <!-- BEGIN title -->
                    <div class="d-flex fw-bold small mb-3">
                        <span class="flex-grow-1"><i class="fa-solid fa-users"></i> Banned Players</span>
                        <a href="#" data-toggle="card-expand" class="text-inverse text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
                    </div>
                    <!-- END title -->
                    <!-- BEGIN stat-lg -->
                    <div class="row align-items-center mb-2">
                        <div class="col-12">
                            <h3 class="mb-0">{{ $bannedPlayerCount }} Players</h3>
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

    <div class="row justify-content-center">
        <div class="col-sm-12 text-center">
            @if($bannedPlayerCount != 0)
                <table class="table table-sm table-hover table-borderless">
                    <thead>
                    <tr>
                        <th>Steam ID</th>
                        <th>Username</th>
                        <th>IP Address</th>
                        <th>Server Name</th>
                        <th>Server IP</th>
                        <th>Time</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($paginatedBans as $ban)
                        <tr>
                            <th>
                                <a href="https://www.steamidfinder.com/lookup/{{ $ban->steam_id }}/" target="_blank"><strong>{{ $ban->steam_id }}</strong></a>
                            </th>
                            <td>{{ $ban->username }}</td>
                            <td>
                                @if($ban->ip_address == "")
                                    No Data - Mass Upload
                                @else
                                    {{ $ban->ip_address }}
                                @endif
                            </td>
                            <td>{{ $ban->server->name }}</td>
                            <td>{{ $ban->server->ip_address }}:{{ $ban->server->port }}</td>
                            <td>{{ $ban->created_at->format('H:i:s | m-d-y') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    <!-- Pagination Links -->
                    {{ $paginatedBans->links('pagination::bootstrap-4') }}
                </div>
            @else
                <h1>Nothing To Show Here</h1>
                <p>You haven't banned anyone yet.</p>
            @endif
        </div>
    </div>



@endsection
