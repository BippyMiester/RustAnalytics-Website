@extends('layouts.dashboard2')

@section('title', $server->name . ' - Destroyed Containers')

@section('breadcrumbs')
    <li class="breadcrumb-item">Servers</li>
    <li class="breadcrumb-item"><a href="{{ route('user.dashboard.server.show', $server->slug) }}">{{ \Illuminate\Support\Str::limit($server->name, 30) }}</a></li>
    <li class="breadcrumb-item active">Destroyed Containers</li>
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
                        <span class="flex-grow-1">Top Destroyed Containers</span>
                        {{--                        <a href="#" data-toggle="card-expand" class="text-inverse text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>--}}
                    </div>
                    <!-- END title -->
                    <!-- BEGIN stat-lg -->
                    <div class="row align-items-center mb-2">
                        <div class="col-12">
                            <p>
                                @foreach ($topDestroyedContainers as $container)
                                    <strong>{{ $container['type'] }}</strong> - {{ $container['count'] }} <br>
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
                                @foreach ($topContainerDestroyers as $player)
                                    <strong>{{ $player['username'] }}</strong> - {{ $player['count'] }} Containers <br>
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
                                @foreach ($mostDestructiveContainerWeapons as $weapon)
                                    <strong>{{ $weapon['weapon'] }}</strong> - {{ $weapon['count'] }} Containers <br>
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
                    <th>Weapon</th>
                    <th>X/Y/Z</th>
                    <th>Grid</th>
                    <th>Time</th>
                </tr>
                </thead>
                <tbody>
                @foreach($destroyedContainers as $container)
                    <tr>
                        <th>
                            <a href="https://www.steamidfinder.com/lookup/{{ $container->steam_id }}/" target="_blank"><strong>{{ $container->steam_id }}</strong></a>
                        </th>
                        <td>{{ $container->username }}</td>
                        <td>{{ $container->owner }}</td>
                        <td>{{ $container->type }}</td>
                        <td>{{ $container->weapon }}</td>
                        @if(!$container->x || !$container->y || !$container->z)
                            <td>No Data</td>
                        @else
                            <td class="copyCoordinates" id="destroyedContainerCoordinate{{ str_replace('.', '', $container->x).str_replace('.', '', $container->y).str_replace('.', '', $container->z) }}">
                                {{ number_format($container->x, 2, '.', '') }}, {{ number_format($container->y, 2, '.', '') }}, {{ number_format($container->z, 2, '.', '') }} <i class="fa-regular fa-copy" style="color: #c0392b; font-size: 1.1em;"></i>
                            </td>
                            <script>
                                document.getElementById("destroyedContainerCoordinate{{ str_replace('.', '', $container->x).str_replace('.', '', $container->y).str_replace('.', '', $container->z) }}").addEventListener('click', function() {
                                    const textToCopy = 'teleportpos ({{ $container->x }},{{ $container->y }},{{ $container->z }})';
                                    navigator.clipboard.writeText(textToCopy).then(() => {
                                        toastify().success('Command Copied Successfully!');
                                        console.log('Text copied to clipboard');
                                    }).catch(err => {
                                        console.error('Error in copying text: ', err);
                                        console.error("placedStructuresCoordinates{{ str_replace('.', '', $container->x).str_replace('.', '', $container->y).str_replace('.', '', $container->z) }}");
                                    });
                                });
                            </script>
                        @endif
                        <td>{{ $container->grid }}</td>
                        <td>{{ $container->created_at->format('H:i:s | m-d-y') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                <!-- Pagination Links -->
                {{ $destroyedContainers->links('pagination::bootstrap-4') }}
            </div>
        </div>

    </div>
    <!-- End Data Cards -->
@endsection
