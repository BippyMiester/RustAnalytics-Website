<div class="tab-pane" id="v-animalKills">
    <div class="row">
        <div class="row">
            <div class="col-sm-3">
                <div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->
                    <!-- panel head -->
                    <div class="panel-heading">
                        <div class="panel-title">Top Killed Animals</div>
                    </div>

                    <!-- panel body -->
                    <div class="panel-body">
                        @foreach ($topAnimalKills as $type)
                            <p><strong>{{ $type['type'] }}</strong> - {{ $type['count'] }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->
                    <!-- panel head -->
                    <div class="panel-heading">
                        <div class="panel-title">Top Kills by Weapon</div>
                    </div>

                    <!-- panel body -->
                    <div class="panel-body">
                        @foreach ($topAnimalKillsWeapons as $weapon)
                            <p><strong>{{ $weapon['weapon'] }}</strong> - {{ $weapon['count'] }} Kills</p>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->
                    <!-- panel head -->
                    <div class="panel-heading">
                        <div class="panel-title">Top Kills by User</div>
                    </div>

                    <!-- panel body -->
                    <div class="panel-body">
                        @foreach ($topAnimalKillsUsers as $username)
                            <p><strong>{{ $username['username'] }}</strong> - {{ $username['count'] }}</p>
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
                    <th>Animal Type</th>
                    <th>Distance</th>
                    <th>Weapon</th>
                    <th>Killed On</th>
                </tr>
                </thead>
                <tbody>
                @foreach($animalKills as $kill)
                    <tr>
                        <th>
                            <a href="https://www.steamidfinder.com/lookup/{{ $kill->steam_id }}/" target="_blank"><strong>{{ $kill->steam_id }}</strong></a>
                        </th>
                        <td>{{ $kill->username }}</td>
                        <td>{{ $kill->animal_type }}</td>
                        <td>{{ $kill->distance }}</td>
                        <td>{{ $kill->weapon }}</td>
                        <td>{{ $kill->created_at->format('H:i:s | m-d-y') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="text-center">
                <!-- Pagination Links -->
                {{ $animalKills->appends(['animalKillsPage' => $animalKills->currentPage(), 'killsPage' => Request::get('killsPage'), 'deathsPage' => Request::input('deathsPage'), 'weaponFirePage' => Request::input('weaponFirePage'), 'destroyedContainersPage' => Request::input('destroyedContainersPage'), 'gatherPage' => Request::input('gatherPage'), 'destroyedBuildingsPage' => Request::input('destroyedBuildingsPage'), 'placedDeployablesPage' => Request::input('placedDeployablesPage'), 'placedStructuresPage' => Request::input('placedStructuresPage')])->links('pagination::bootstrap-4') }}
            </div>
        </div>

    </div>
</div>


