@extends('layouts.dashboard2')

@section('title', $server->name . ' - Player Connections')

@section('breadcrumbs')
    <li class="breadcrumb-item">Servers</li>
    <li class="breadcrumb-item"><a href="{{ route('user.dashboard.server.show', $server->slug) }}">{{ \Illuminate\Support\Str::limit($server->name, 30) }}</a></li>
    <li class="breadcrumb-item active">Player Connections</li>
@endsection

@section('content')

    <!-- Start Data Cards -->
    <div class="row">
        <div class="col-sm-12">
            <table class="table table-sm table-hover table-borderless">
                <thead>
                <tr>
                    <th>Steam ID</th>
                    <th>Username</th>
                    <th>IP Address</th>
                    <th>Connection Type</th>
                    <th>Total Online Time</th>
                    <th>Total AFK Time</th>
                    <th>Timestamp</th>
                </tr>
                </thead>
                <tbody>
                @foreach($players as $player)
                    <tr>
                        <th>
                            <a href="https://www.steamidfinder.com/lookup/{{ $player->steam_id }}/" target="_blank"><strong>{{ $player->steam_id }}</strong></a>
                        </th>
                        <td>{{ $player->username }}</td>
                        <td>{{ $player->ip_address }}</td>
                        <td>
                            @if($player->type == "connect")
                                <span class="badge bg-success">Login</span>
                            @else
                                <span class="badge bg-danger">Logout</span>
                            @endif
                        </td>
                        <td>
                            @php
                                $seconds = $player->online_seconds;
                                $zero = Carbon\Carbon::now()->startOfDay(); // Get a Carbon instance at 00:00:00 today
                                $duration = Carbon\Carbon::now()->startOfDay()->addSeconds($seconds); // Add the online seconds to another Carbon instance at 00:00:00

                                $days = $duration->diffInDays($zero);
                                $hours = $duration->copy()->subDays($days)->diffInHours($zero);
                                $minutes = $duration->copy()->subDays($days)->subHours($hours)->diffInMinutes($zero);
                                $seconds = $duration->copy()->subDays($days)->subHours($hours)->subMinutes($minutes)->diffInSeconds($zero);
                            @endphp

                            {{ "{$days} Days, {$hours} Hours, {$minutes} Minutes, {$seconds} Seconds" }}
                        </td>
                        <td>
                            @php
                                $seconds = $player->afk_seconds;
                                $zero = Carbon\Carbon::now()->startOfDay(); // Get a Carbon instance at 00:00:00 today
                                $duration = Carbon\Carbon::now()->startOfDay()->addSeconds($seconds); // Add the online seconds to another Carbon instance at 00:00:00

                                $days = $duration->diffInDays($zero);
                                $hours = $duration->copy()->subDays($days)->diffInHours($zero);
                                $minutes = $duration->copy()->subDays($days)->subHours($hours)->diffInMinutes($zero);
                                $seconds = $duration->copy()->subDays($days)->subHours($hours)->subMinutes($minutes)->diffInSeconds($zero);
                            @endphp

                            {{ "{$days} Days, {$hours} Hours, {$minutes} Minutes, {$seconds} Seconds" }}
                        </td>
                        <td>{{ $player->created_at->format('H:i:s | m-d-y') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                <!-- Pagination Links -->
                {{ $players->links('pagination::bootstrap-4') }}
            </div>
        </div>

    </div>
    <!-- End Data Cards -->
@endsection
