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

