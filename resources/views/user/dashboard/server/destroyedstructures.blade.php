@extends('layouts.dashboard2')

@section('title', $server->name . ' - Destroyed Structures')

@section('breadcrumbs')
    <li class="breadcrumb-item">Servers</li>
    <li class="breadcrumb-item"><a href="{{ route('user.dashboard.server.show', $server->slug) }}">{{ \Illuminate\Support\Str::limit($server->name, 30) }}</a></li>
    <li class="breadcrumb-item active">Destroyed Structures</li>
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
                        <span class="flex-grow-1">Top Destroyed Buildings</span>
                        {{--                        <a href="#" data-toggle="card-expand" class="text-inverse text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>--}}
                    </div>
                    <!-- END title -->
                    <!-- BEGIN stat-lg -->
                    <div class="row align-items-center mb-2">
                        <div class="col-12">
                            <p>
                                @foreach ($topDestroyedBuildingTypes as $type)
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
                        <span class="flex-grow-1">Most Destructive Players</span>
                        {{--                        <a href="#" data-toggle="card-expand" class="text-inverse text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>--}}
                    </div>
                    <!-- END title -->
                    <!-- BEGIN stat-lg -->
                    <div class="row align-items-center mb-2">
                        <div class="col-12">
                            <p>
                                @foreach ($topDestroyers as $player)
                                    <strong>{{ $player['username'] }}</strong> - {{ $player['count'] }} Structures <br>
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
                        <span class="flex-grow-1">Most Destructive Weapons</span>
                        {{--                        <a href="#" data-toggle="card-expand" class="text-inverse text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>--}}
                    </div>
                    <!-- END title -->
                    <!-- BEGIN stat-lg -->
                    <div class="row align-items-center mb-2">
                        <div class="col-12">
                            <p>
                                @foreach ($mostDestructiveBuildingWeapons as $weapon)
                                    <strong>{{ $weapon['weapon'] }}</strong> - {{ $weapon['count'] }} Structures <br>
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
                    <th>Victim/Owner</th>
                    <th>Type</th>
                    <th>Tier</th>
                    <th>Weapon</th>
                    <th>X/Y/Z</th>
                    <th>Grid</th>
                    <th>Time</th>
                </tr>
                </thead>
                <tbody>
                @foreach($destroyedBuildings as $building)
                    <tr>
                        <th>
                            <a href="https://www.steamidfinder.com/lookup/{{ $building->steam_id }}/" target="_blank"><strong>{{ $building->steam_id }}</strong></a>
                        </th>
                        <td>{{ $building->username }}</td>
                        <td>{{ $building->owner }}</td>
                        <td>{{ $building->type }}</td>
                        <td>{{ $building->tier }}</td>
                        <td>{{ $building->weapon }}</td>
                        @if(!$building->x || !$building->y || !$building->z)
                            <td>No Data</td>
                        @else
                            <td class="copyCoordinates" id="destroyedBuildingCoordinates{{ str_replace('.', '', $building->x).str_replace('.', '', $building->y).str_replace('.', '', $building->z) }}">
                                {{ number_format($building->x, 2, '.', '') }}, {{ number_format($building->y, 2, '.', '') }}, {{ number_format($building->z, 2, '.', '') }} <i class="fa-regular fa-copy" style="color: #c0392b; font-size: 1.1em;"></i>
                            </td>
                            <script>
                                document.getElementById("destroyedBuildingCoordinates{{ str_replace('.', '', $building->x).str_replace('.', '', $building->y).str_replace('.', '', $building->z) }}").addEventListener('click', function() {
                                    const textToCopy = 'teleportpos ({{ $building->x }},{{ $building->y }},{{ $building->z }})';
                                    navigator.clipboard.writeText(textToCopy).then(() => {
                                        toastify().success('Command Copied Successfully!');
                                        console.log('Text copied to clipboard');
                                    }).catch(err => {
                                        console.error('Error in copying text: ', err);
                                        console.error("placedStructuresCoordinates{{ str_replace('.', '', $building->x).str_replace('.', '', $building->y).str_replace('.', '', $building->z) }}");
                                    });
                                });
                            </script>
                        @endif
                        <td>{{ $building->grid }}</td>
                        <td>{{ $building->created_at->format('H:i:s | m-d-y') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                <!-- Pagination Links -->
                {{ $destroyedBuildings->links('pagination::bootstrap-4') }}
            </div>
        </div>

    </div>
    <!-- End Data Cards -->
@endsection
