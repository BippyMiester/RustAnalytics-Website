<div class="tab-pane" id="v-destroyedBuildings">
    <div class="row">
        <div class="row">
            <div class="col-sm-3">
                <div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->
                    <!-- panel head -->
                    <div class="panel-heading">
                        <div class="panel-title">Top Destroyed Buildings</div>
                    </div>

                    <!-- panel body -->
                    <div class="panel-body">
                        @foreach ($topDestroyedBuildingTypes as $type)
                            <p><strong>{{ $type['type'] }}</strong> - {{ $type['count'] }}</p>
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
                        @foreach ($topDestroyers as $player)
                            <p><strong>{{ $player['username'] }}</strong> - {{ $player['count'] }} Buildings</p>
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
                        @foreach ($mostDestructiveBuildingWeapons as $weapon)
                            <p><strong>{{ $weapon['weapon'] }}</strong> - {{ $weapon['count'] }} Buildings</p>
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
                    <th>Tier</th>
                    <th>Weapon</th>
                    <th>X/Y/Z</th>
                    <th>Grid</th>
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
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="text-center">
                <!-- Pagination Links -->
                {{ $destroyedBuildings->appends(['destroyedBuildingsPage' => $destroyedBuildings->currentPage(), 'killsPage' => Request::get('killsPage'), 'deathsPage' => Request::input('deathsPage'), 'weaponFirePage' => Request::input('weaponFirePage'), 'destroyedContainersPage' => Request::input('destroyedContainersPage'), 'gatherPage' => Request::input('gatherPage'), 'placedStructuresPage' => Request::input('placedStructuresPage')])->links('pagination::bootstrap-4') }}
            </div>
        </div>

    </div>
</div>

