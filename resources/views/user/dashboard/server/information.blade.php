@extends('layouts.dashboard2')

@section('title', $server->name . ' - Information')

@section('breadcrumbs')
    <li class="breadcrumb-item">Servers</li>
    <li class="breadcrumb-item"><a href="{{ route('user.dashboard.server.show', $server->slug) }}">{{ \Illuminate\Support\Str::limit($server->name, 30) }}</a></li>
    <li class="breadcrumb-item active">Information</li>
@endsection

@section('content')

    <div class="row justify-content-center">
        <div class="col-sm-6">
            <div class="mb-5">
                <h4><i class="fa-solid fa-info fa-fw text-theme"></i> General Information</h4>
                <div class="card">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-1 text-break">
                                <div>Name</div>
                                <div class="text-inverse text-opacity-50">{{ $server->name }}</div>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-1 text-break">
                                <div>Tags</div>
                                <div class="text-inverse text-opacity-50">{{ $server->tags }}</div>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-1 text-break">
                                <div>IP Address</div>
                                <div class="text-inverse text-opacity-50">{{ $server->ip_address }}:{{ $server->port }}</div>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-1 text-break">
                                <div>Protocol</div>
                                <div class="text-inverse text-opacity-50">{{ $server->protocol }}</div>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-1 text-break">
                                <div>Current Plugin Version</div>
                                <div class="text-inverse text-opacity-50">{{ $server->version }}</div>
                            </div>
                        </div>
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
        <div class="col-sm-6">
            <div class="mb-5">
                <h4><i class="fa-regular fa-map fa-fw text-theme"></i> Map Information</h4>
                <div class="card">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-1 text-break">
                                <div>World Name</div>
                                <div class="text-inverse text-opacity-50">{{ $server->world_name }}</div>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-1 text-break">
                                <div>World Seed</div>
                                <div class="text-inverse text-opacity-50">{{ $server->world_seed }}</div>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-1 text-break">
                                <div>Map Size</div>
                                <div class="text-inverse text-opacity-50">{{ $server->map_size }}k</div>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-1 text-break">
                                <div>Last Wiped</div>
                                <div class="text-inverse text-opacity-50">{{ $server->last_wiped->format('H:i:s | m-d-y') }}</div>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-1 text-break">
                                <div>Last Blueprint Wipe</div>
                                <div class="text-inverse text-opacity-50">{{ $server->blueprint_last_wiped->format('H:i:s | m-d-y') }}</div>
                            </div>
                        </div>
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
    </div>

    <div class="row justify-content-center">
        <div class="col-sm-6">
            <div class="mb-5">
                <h4><i class="fa-solid fa-gears fa-fw text-theme"></i> Technical Information</h4>
                <div class="card">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-1 text-break">
                                <div>Entities</div>
                                <div class="text-inverse text-opacity-50">{{ $serverData->entities }}</div>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-1 text-break">
                                <div>Players Online</div>
                                <div class="text-inverse text-opacity-50">{{ $serverData->players_online }} / {{ $serverData->players_max }}</div>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-1 text-break">
                                <div>In Game Time</div>
                                <div class="text-inverse text-opacity-50">{{ $serverData->in_game_time }}</div>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-1 text-break">
                                <div>Server FPS</div>
                                <div class="text-inverse text-opacity-50">{{ $serverData->server_fps }} fps</div>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-1 text-break">
                                <div>Memory Usage</div>
                                <div class="text-inverse text-opacity-50">{{ $serverData->used_memory }}/{{ $serverData->max_memory }} GB</div>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="flex-1 text-break">
                                <div>Network Usage</div>
                                <div class="text-inverse text-opacity-50">{{ $serverData->network_in }}/{{ $serverData->network_out }}</div>
                            </div>
                        </div>
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
    </div>

@endsection
