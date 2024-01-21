<div class="tab-pane" id="v-placedBuildings">
    <div class="row">
        <div class="row">
            <div class="col-sm-3">
                <div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->
                    <!-- panel head -->
                    <div class="panel-heading">
                        <div class="panel-title">Top Placed Buildings</div>
                    </div>

                    <!-- panel body -->
                    <div class="panel-body">
                        @foreach ($topPlacedStructures as $type)
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
                        @foreach ($topPlacedStructuresPlayers as $player)
                            <p><strong>{{ $player['username'] }}</strong> - {{ $player['count'] }} Buildings</p>
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
                @foreach($placedStructures as $building)
                    <tr>
                        <th>
                            <a href="https://www.steamidfinder.com/lookup/{{ $building->steam_id }}/" target="_blank"><strong>{{ $building->steam_id }}</strong></a>
                        </th>
                        <td>{{ $building->username }}</td>
                        <td>{{ $building->type }}</td>
                        @if(!$building->x || !$building->y || !$building->z)
                            <td>No Data</td>
                        @else
                            <td class="copyCoordinates" id="placedStructuresCoordinates{{ str_replace('.', '', $building->x).str_replace('.', '', $building->y).str_replace('.', '', $building->z) }}">
                                {{ number_format($building->x, 2, '.', '') }}, {{ number_format($building->y, 2, '.', '') }}, {{ number_format($building->z, 2, '.', '') }} <i class="fa-regular fa-copy" style="color: #c0392b; font-size: 1.1em;"></i>
                            </td>
                            <script>
                                document.getElementById("placedStructuresCoordinates{{ str_replace('.', '', $building->x).str_replace('.', '', $building->y).str_replace('.', '', $building->z) }}").addEventListener('click', function() {
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

                        <td>
                            @if($building->grid == null)
                                No Data
                            @else
                                {{ $building->grid }}
                            @endif
                        </td>
                        <td>{{ $building->created_at->format('H:i:s | m-d-y') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="text-center">
                <!-- Pagination Links -->
                {{ $placedStructures->appends(['placedStructuresPage' => $placedStructures->currentPage(), 'killsPage' => Request::get('killsPage'), 'deathsPage' => Request::input('deathsPage'), 'weaponFirePage' => Request::input('weaponFirePage'), 'destroyedContainersPage' => Request::input('destroyedContainersPage'), 'gatherPage' => Request::input('gatherPage'), 'destroyedBuildingsPage' => Request::input('destroyedBuildingsPage')])->links('pagination::bootstrap-4') }}
            </div>
        </div>

    </div>
</div>


