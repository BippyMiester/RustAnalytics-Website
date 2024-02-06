@extends('layouts.dashboard2')

@section('title', $server->name . ' - Placed Deployables')

@section('breadcrumbs')
    <li class="breadcrumb-item">Servers</li>
    <li class="breadcrumb-item"><a href="{{ route('user.dashboard.server.show', $server->slug) }}">{{ \Illuminate\Support\Str::limit($server->name, 30) }}</a></li>
    <li class="breadcrumb-item active">Placed Deployables</li>
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
                        <span class="flex-grow-1">Top Placed Deployables</span>
                        {{--                        <a href="#" data-toggle="card-expand" class="text-inverse text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>--}}
                    </div>
                    <!-- END title -->
                    <!-- BEGIN stat-lg -->
                    <div class="row align-items-center mb-2">
                        <div class="col-12">
                            <p>
                                @foreach ($topPlacedDeployables as $type)
                                    <strong>{{ $type['type'] }}</strong> - {{ $type['count'] }} <br>
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
                        <span class="flex-grow-1">Most Constructive Players</span>
                        {{--                        <a href="#" data-toggle="card-expand" class="text-inverse text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>--}}
                    </div>
                    <!-- END title -->
                    <!-- BEGIN stat-lg -->
                    <div class="row align-items-center mb-2">
                        <div class="col-12">
                            <p>
                                @foreach ($topPlacedDeployablesPlayers as $player)
                                    <strong>{{ $player['username'] }}</strong> - {{ $player['count'] }} Deployables <br>
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
                    <th>Steam ID</th>
                    <th>Username</th>
                    <th>Type</th>
                    <th>X/Y/Z</th>
                    <th>Grid</th>
                    <th>Placed On</th>
                </tr>
                </thead>
                <tbody>
                @foreach($placedDeployables as $deployable)
                    <tr>
                        <th>
                            <a href="https://www.steamidfinder.com/lookup/{{ $deployable->steam_id }}/" target="_blank"><strong>{{ $deployable->steam_id }}</strong></a>
                        </th>
                        <td>{{ $deployable->username }}</td>
                        <td>{{ $deployable->type }}</td>
                        @if(!$deployable->x || !$deployable->y || !$deployable->z)
                            <td>No Data</td>
                        @else
                            <td class="copyCoordinates" id="placedStructuresCoordinates{{ str_replace('.', '', $deployable->x).str_replace('.', '', $deployable->y).str_replace('.', '', $deployable->z) }}">
                                {{ number_format($deployable->x, 2, '.', '') }}, {{ number_format($deployable->y, 2, '.', '') }}, {{ number_format($deployable->z, 2, '.', '') }} <i class="fa-regular fa-copy" style="color: #c0392b; font-size: 1.1em;"></i>
                            </td>
                            <script>
                                document.getElementById("placedStructuresCoordinates{{ str_replace('.', '', $deployable->x).str_replace('.', '', $deployable->y).str_replace('.', '', $deployable->z) }}").addEventListener('click', function() {
                                    const textToCopy = 'teleportpos ({{ $deployable->x }},{{ $deployable->y }},{{ $deployable->z }})';
                                    navigator.clipboard.writeText(textToCopy).then(() => {
                                        toastify().success('Command Copied Successfully!');
                                        console.log('Text copied to clipboard');
                                    }).catch(err => {
                                        console.error('Error in copying text: ', err);
                                        console.error("placedStructuresCoordinates{{ str_replace('.', '', $deployable->x).str_replace('.', '', $deployable->y).str_replace('.', '', $deployable->z) }}");
                                    });
                                });
                            </script>
                        @endif

                        <td>
                            @if($deployable->grid == null)
                                No Data
                            @else
                                {{ $deployable->grid }}
                            @endif
                        </td>
                        <td>{{ $deployable->created_at->format('H:i:s | m-d-y') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                <!-- Pagination Links -->
                {{ $placedDeployables->links('pagination::bootstrap-4') }}
            </div>
        </div>

    </div>
    <!-- End Data Cards -->
@endsection
