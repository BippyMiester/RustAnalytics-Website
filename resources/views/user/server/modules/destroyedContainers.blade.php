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
                    <th>Grid</th>
                    <th>X, Y</th>
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
                        <td>{{ $container->grid }}</td>
                        <td>{{ $container->x . ', ' . $container->y }}</td>
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

