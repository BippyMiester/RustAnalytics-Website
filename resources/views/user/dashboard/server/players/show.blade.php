@extends('layouts.dashboard2')

@section('title', $server->name . ' - ' . $player->username)

@section('breadcrumbs')
    <li class="breadcrumb-item">Servers</li>
    <li class="breadcrumb-item"><a href="{{ route('user.dashboard.server.show', $server->slug) }}">{{ \Illuminate\Support\Str::limit($server->name, 30) }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('user.dashboard.server.players.index', $server->slug) }}">Players</a></li>
    <li class="breadcrumb-item">{{ $player->username }}</li>
@endsection

@section('content')

    <div class="row gx-4">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center bg-inverse bg-opacity-10 fw-400">
                    Basic Information
                </div>
                <div class="card-body text-inverse">
                    <table class="table table-borderless table-sm m-0">
                        <tbody>
                        <tr>
                            <td class="w-150px">First Connected</td>
                            <td>{{ $player->created_at->format('H:i:s | m-d-y') }}</td>
                        </tr>
                        <tr>
                            <td class="w-150px">Steam ID</td>
                            <td>{{ $player->steam_id }}</td>
                        </tr>
                        <tr>
                            <td class="w-150px">Username</td>
                            <td>{{ $player->username }}</td>
                        </tr>
                        <tr>
                            <td class="w-150px">Online Time</td>
                            <td>
                                @php
                                    $seconds = $playerLastConnection->online_seconds;
                                    $zero = Carbon\Carbon::now()->startOfDay(); // Get a Carbon instance at 00:00:00 today
                                    $duration = Carbon\Carbon::now()->startOfDay()->addSeconds($seconds); // Add the online seconds to another Carbon instance at 00:00:00

                                    $days = $duration->diffInDays($zero);
                                    $hours = $duration->copy()->subDays($days)->diffInHours($zero);
                                    $minutes = $duration->copy()->subDays($days)->subHours($hours)->diffInMinutes($zero);
                                    $seconds = $duration->copy()->subDays($days)->subHours($hours)->subMinutes($minutes)->diffInSeconds($zero);
                                @endphp

                                {{ "{$days} Days, {$hours} Hours, {$minutes} Minutes, {$seconds} Seconds" }}
                            </td>
                        </tr>
                        <tr>
                            <td class="w-150px">AFK Time</td>
                            <td>
                                @php
                                    $seconds = $playerLastConnection->afk_seconds;
                                    $zero = Carbon\Carbon::now()->startOfDay(); // Get a Carbon instance at 00:00:00 today
                                    $duration = Carbon\Carbon::now()->startOfDay()->addSeconds($seconds); // Add the online seconds to another Carbon instance at 00:00:00

                                    $days = $duration->diffInDays($zero);
                                    $hours = $duration->copy()->subDays($days)->diffInHours($zero);
                                    $minutes = $duration->copy()->subDays($days)->subHours($hours)->diffInMinutes($zero);
                                    $seconds = $duration->copy()->subDays($days)->subHours($hours)->subMinutes($minutes)->diffInSeconds($zero);
                                @endphp

                                {{ "{$days} Days, {$hours} Hours, {$minutes} Minutes, {$seconds} Seconds" }}
                            </td>
                        </tr>
                        <tr>
                            <td class="w-150px">Online?</td>
                            <td>
                                @if($playerLastConnection->type == "connect")
                                    <span class="badge bg-success">Online</span>
                                @else
                                    <span class="badge bg-danger">Offline</span>
                                @endif
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-arrow">
                    <div class="card-arrow-top-left"></div>
                    <div class="card-arrow-top-right"></div>
                    <div class="card-arrow-bottom-left"></div>
                    <div class="card-arrow-bottom-right"></div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header d-flex align-items-center bg-inverse bg-opacity-10 fw-400">
                    Player IP Addresses
                </div>
                <div class="card-body">
                    @foreach($proxyCheckCollection as $proxyCheck)
                        @if($proxyCheck)
                            <h3>{{ $proxyCheck->ip_address }}</h3>
                            <hr>
                            <table class="table table-borderless table-sm m-0">
                                <tbody>
                                <tr>
                                    <td class="w-150px">ASN</td>
                                    <td>{{ $proxyCheck->asn }}</td>
                                    <td class="w-150px">Range</td>
                                    <td>{{ $proxyCheck->range }}</td>
                                </tr>
                                <tr>
                                    <td class="w-150px">Provider</td>
                                    <td>{{ $proxyCheck->provider }}</td>
                                    <td class="w-150px">Continent</td>
                                    <td>{{ $proxyCheck->continent }}</td>
                                </tr>
                                <tr>
                                    <td class="w-150px">Continent Code</td>
                                    <td>{{ $proxyCheck->continent_code }}</td>
                                    <td class="w-150px">Country</td>
                                    <td>{{ $proxyCheck->country }}</td>
                                </tr>
                                <tr>
                                    <td class="w-150px">isocode</td>
                                    <td>{{ $proxyCheck->isocode }}</td>
                                    <td class="w-150px">Region Code</td>
                                    <td>{{ $proxyCheck->regioncode }}</td>
                                </tr>
                                <tr>
                                    <td class="w-150px">Time Zone</td>
                                    <td>{{ $proxyCheck->timezone }}</td>
                                    <td class="w-150px">City</td>
                                    <td>{{ $proxyCheck->city }}</td>
                                </tr>
                                <tr>
                                    <td class="w-150px">Postal Code</td>
                                    <td>{{ $proxyCheck->postcode }}</td>
                                    <td class="w-150px">Is Proxy</td>
                                    <td>
                                        @if($proxyCheck->proxy == false)
                                            <span class="badge bg-success">Not A Proxy</span>
                                        @else
                                            <span class="badge bg-danger">Proxy Detected!</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-150px">Type of IP</td>
                                    <td>{{ $proxyCheck->type }}</td>
                                    <td class="w-150px">Global Blocked</td>
                                    <td>
                                        @if($proxyCheck->blocked == false)
                                            <span class="badge bg-success">Not Blocked</span>
                                        @else
                                            <span class="badge bg-danger">Global Block Detected!</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-150px">Blocked Reason</td>
                                    <td>{{ $proxyCheck->block_reason }}</td>
                                    <td class="w-150px">Last Updated At</td>
                                    <td>{{ $proxyCheck->updated_at->format('H:i:s | m-d-y') }}</td>
                                </tr>
                                </tbody>
                            </table>
                        @else
                            <p>Nothing to show here yet. This is probably because you're in a testing development environment. Your IP address has probably been logged as 127.0.0.1 which the proxy check API can't handle due to it being a local IP address. Once you connect to the production server and RustAnalytics captures your real IP, then information will show up.</p>
                            <p>Either that... or something fucked up on me end. Let me know! :P</p>
                        @endif
                    @endforeach
                </div>
                <div class="card-arrow">
                    <div class="card-arrow-top-left"></div>
                    <div class="card-arrow-top-right"></div>
                    <div class="card-arrow-bottom-left"></div>
                    <div class="card-arrow-bottom-right"></div>
                </div>
            </div>

        </div>

        <div class="col-lg-4">



            <div class="card mb-4">
                <div class="card-header d-flex align-items-center bg-inverse bg-opacity-10 fw-400">
                    General Info (Battlemetrics)
                </div>
                <div class="card-body">
                    @if($battlemetricsPlayer != null)
                        <table class="table table-borderless table-sm m-0">
                            <tbody>
                            <tr>
                                <td class="w-150px">Battlemetrics ID</td>
                                <td>
                                    <a href="https://www.battlemetrics.com/players/{{ $battlemetricsPlayer->battlemetrics_id }}" target="_blank">
                                        {{ $battlemetricsPlayer->battlemetrics_id }}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="w-150px">Profile Status</td>
                                <td>
                                    @if($battlemetricsPlayer->profile_status == "public")
                                        <span class="badge bg-success">Public</span>
                                    @else
                                        <span class="badge bg-danger">Private</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="w-150px">Username</td>
                                <td>
                                    {{ $battlemetricsPlayer->username }}
                                </td>
                            </tr>
                            <tr>
                                <td class="w-150px">Steam Profile Page</td>
                                <td>
                                    <a href="{{ $battlemetricsPlayer->profile_url }}">{{ $battlemetricsPlayer->username }}'s Profile</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="w-150px">Profile Image</td>
                                <td>
                                    <img src="{{ $battlemetricsPlayer->steam_avatar }}" class="w-25" alt="{{ $battlemetricsPlayer->username }}'s Steam Profile Picture">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    @else
                        <p>No Information from BattleMetrics or their profile is private</p>
                    @endif
                </div>
                <div class="card-arrow">
                    <div class="card-arrow-top-left"></div>
                    <div class="card-arrow-top-right"></div>
                    <div class="card-arrow-bottom-left"></div>
                    <div class="card-arrow-bottom-right"></div>
                </div>
            </div>


            <div class="card mb-4">
                <div class="card-header d-flex align-items-center bg-inverse bg-opacity-10 fw-400">
                    Ban Info (Battlemetrics)
                </div>
                <div class="card-body">
                    @if($battlemetricsPlayer != null)
                        <table class="table table-borderless table-sm m-0">
                            <tbody>
                            <tr>
                                <td class="w-200px">VAC Banned</td>
                                <td>
                                    @if($battlemetricsPlayer->vac_banned == false)
                                        <span class="badge bg-success">Not Banned</span>
                                    @else
                                        <span class="badge bg-danger">Banned</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="w-200px">VAC Ban Count</td>
                                <td>
                                    {{ $battlemetricsPlayer->vac_ban_count }}
                                </td>
                            </tr>
                            <tr>
                                <td class="w-200px">Community Banned</td>
                                <td>
                                    @if($battlemetricsPlayer->community_banned == false)
                                        <span class="badge bg-success">Not Banned</span>
                                    @else
                                        <span class="badge bg-danger">Banned</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="w-200px">Days Since Last Ban</td>
                                <td>
                                    {{ $battlemetricsPlayer->days_since_last_ban }}
                                </td>
                            </tr>
                            <tr>
                                <td class="w-200px">Game Bans Count</td>
                                <td>
                                    {{ $battlemetricsPlayer->game_bans_count }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    @else
                        <p>No Information from BattleMetrics or their profile is private</p>
                    @endif
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

@endsection
