<div class="tab-pane" id="v-destroyedContainers">
    <div class="row">
        <div class="row">
            <div class="col-sm-3">
                <div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->
                    <!-- panel head -->
                    <div class="panel-heading">
                        <div class="panel-title">Top Destroyed Containers</div>
                    </div>

                    <!-- panel body -->
                    <div class="panel-body">
                        @foreach ($topDestroyedContainers as $container)
                            <p><strong>{{ $container['type'] }}</strong> - {{ $container['count'] }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->
                    <!-- panel head -->
                    <div class="panel-heading">
                        <div class="panel-title">Most Destructive Players</div>
                    </div>

                    <!-- panel body -->
                    <div class="panel-body">
                        @foreach ($topContainerDestroyers as $player)
                            <p><strong>{{ $player['username'] }}</strong> - {{ $player['count'] }} Containers</p>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->
                    <!-- panel head -->
                    <div class="panel-heading">
                        <div class="panel-title">Most Destructive Weapons</div>
                    </div>

                    <!-- panel body -->
                    <div class="panel-body">
                        @foreach ($mostDestructiveContainerWeapons as $weapon)
                            <p><strong>{{ $weapon['weapon'] }}</strong> - {{ $weapon['count'] }} Containers</p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="text-center">
                <!-- Pagination Links -->
                {{ $destroyedContainers->appends(['destroyedContainersPage' => $destroyedContainers->currentPage(), 'killsPage' => Request::get('killsPage'), 'deathsPage' => Request::input('deathsPage'), 'weaponFirePage' => Request::input('weaponFirePage'), 'destroyedBuildingsPage' => Request::input('destroyedBuildingsPage'), 'gatherPage' => Request::input('gatherPage'), 'placedStructuresPage' => Request::input('placedStructuresPage')])->links('pagination::bootstrap-4') }}
            </div>
        </div>

    </div>
</div>

