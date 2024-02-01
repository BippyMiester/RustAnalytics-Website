<div class="tab-pane" id="v-placedDeployables">
    <div class="row">
        <div class="row">
            <div class="col-sm-3">
                <div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->
                    <!-- panel head -->
                    <div class="panel-heading">
                        <div class="panel-title">Top Placed Deployables</div>
                    </div>

                    <!-- panel body -->
                    <div class="panel-body">
                        @foreach ($topPlacedDeployables as $type)
                            <p><strong>{{ $type['type'] }}</strong> - {{ $type['count'] }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->
                    <!-- panel head -->
                    <div class="panel-heading">
                        <div class="panel-title">Most Constructive Players</div>
                    </div>

                    <!-- panel body -->
                    <div class="panel-body">
                        @foreach ($topPlacedDeployablesPlayers as $player)
                            <p><strong>{{ $player['username'] }}</strong> - {{ $player['count'] }} Deployables</p>
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
            <div class="text-center">
                <!-- Pagination Links -->
                {{ $placedDeployables->appends(['placedDeployablesPage' => $placedDeployables->currentPage(), 'killsPage' => Request::get('killsPage'), 'deathsPage' => Request::input('deathsPage'), 'weaponFirePage' => Request::input('weaponFirePage'), 'destroyedContainersPage' => Request::input('destroyedContainersPage'), 'gatherPage' => Request::input('gatherPage'), 'destroyedBuildingsPage' => Request::input('destroyedBuildingsPage'), 'placedBuildingsPage' => Request::input('placedBuildingsPage')])->links('pagination::bootstrap-4') }}
            </div>
        </div>

    </div>
</div>


