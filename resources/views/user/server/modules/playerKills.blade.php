<div class="tab-pane" id="v-playerKills">
    <div class="row">
        <div class="row">
            <div class="col-sm-3">
                <div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->
                    <!-- panel head -->
                    <div class="panel-heading">
                        <div class="panel-title">Top Kills</div>
                    </div>

                    <!-- panel body -->
                    <div class="panel-body">
                        @foreach ($topPlayerKills as $player)
                            <p><strong>{{ $player['username'] }}</strong> - {{ $player['kill_count'] }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->
                    <!-- panel head -->
                    <div class="panel-heading">
                        <div class="panel-title">Top Weapons Used</div>
                    </div>

                    <!-- panel body -->
                    <div class="panel-body">
                        @foreach ($topPlayerKillsWeapons as $weapon)
                            <p><strong>{{ $weapon['weapon'] }}</strong> - {{ $weapon['count'] }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->
                    <!-- panel head -->
                    <div class="panel-heading">
                        <div class="panel-title">Top Deaths</div>
                    </div>

                    <!-- panel body -->
                    <div class="panel-body">
                        @foreach ($topPlayerDeaths as $player)
                            <p><strong>{{ $player['username'] }}</strong> - {{ $player['death_count'] }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->
                    <!-- panel head -->
                    <div class="panel-heading">
                        <div class="panel-title">Top Cause Of Death</div>
                    </div>

                    <!-- panel body -->
                    <div class="panel-body">
                        @foreach ($topPlayerDeathsCause as $death)
                            <p><strong>{{ $death['cause'] }}</strong> - {{ $death['count'] }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->
                    <!-- panel head -->
                    <div class="panel-heading">
                        <div class="panel-title">Top Death Locations By Grid</div>
                    </div>

                    <!-- panel body -->
                    <div class="panel-body">
                        @foreach ($topPlayerDeathGrid as $grid)
                            <p><strong>{{ $grid['grid'] }}</strong> - {{ $grid['count'] }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->
                    <!-- panel head -->
                    <div class="panel-heading">
                        <div class="panel-title">Most Hit Body Part</div>
                    </div>

                    <!-- panel body -->
                    <div class="panel-body">
                        @foreach ($killsBodyPartChart as $bodyPartData)
                            <p>{{ $bodyPartData['body_part'] }}: {{ $bodyPartData['count'] }}</p>
                        @endforeach
                        <div class="text-center">
                            <span class="pie-body-part-kills"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->
                    <!-- panel head -->
                    <div class="panel-heading">
                        <div class="panel-title">Top 10 Longest Distances</div>
                    </div>

                    <!-- panel body -->
                    <div class="panel-body">
                        @foreach ($topPlayerKillDistances as $kill)
                            <p><strong>{{ $kill['username'] }}</strong> - {{ $kill['distance'] }} meters</p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <h3>Kills</h3>
            <table class="table table-sm table-hover table-borderless">
                <thead>
                <tr>
                    <th>Kill ID</th>
                    <th>Steam ID</th>
                    <th>Username</th>
                    <th>Victim</th>
                    <th>Weapon</th>
                    <th>Body Part</th>
                    <th>Distance</th>
                </tr>
                </thead>
                <tbody>
                @foreach($playerKills as $kill)
                    <tr>
                        <th>{{ $kill->kill_id }}</th>
                        <th>
                            <a href="https://www.steamidfinder.com/lookup/{{ $kill->steam_id }}/" target="_blank"><strong>{{ $kill->steam_id }}</strong></a>
                        </th>
                        <td>{{ $kill->username }}</td>
                        <td>{{ $kill->victim }}</td>
                        <td>{{ $kill->weapon }}</td>
                        <td>{{ $kill->body_part }}</td>
                        <td>{{ $kill->distance }} m</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="text-center">
                <!-- Pagination Links -->
                {{ $playerKills->appends(['killsPage' => $playerKills->currentPage(), 'gatherPage' => Request::input('gatherPage'), 'deathsPage' => Request::input('deathsPage'), 'weaponFirePage' => Request::input('weaponFirePage')])->links('pagination::bootstrap-4') }}
            </div>
        </div>

        <div class="col-sm-6">
            <h3>Deaths</h3>
            <table class="table table-sm table-hover table-borderless">
                <thead>
                <tr>
                    <th>Steam ID</th>
                    <th>Username</th>
                    <th>Cause</th>
                    <th>X/Y</th>
                    <th>Grid</th>
                </tr>
                </thead>
                <tbody>
                @foreach($playerDeaths as $death)
                    <tr>
                        <th>
                            <a href="https://www.steamidfinder.com/lookup/{{ $death->steam_id }}/" target="_blank"><strong>{{ $death->steam_id }}</strong></a>
                        </th>
                        <td>{{ $death->username }}</td>
                        <td>{{ $death->cause }}</td>
                        <td>{{ $death->x }}, {{ $death->y }}</td>
                        <td>{{ $death->grid }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="text-center">
                <!-- Pagination Links -->
                {{ $playerDeaths->appends(['deathsPage' => $playerDeaths->currentPage(), 'gatherPage' => Request::input('gatherPage'), 'killsPage' => Request::input('killsPage'), 'weaponFirePage' => Request::input('weaponFirePage'), 'destroyedBuildingsPage' => Request::input('destroyedBuildingsPage')])->links('pagination::bootstrap-4') }}
            </div>
        </div>

    </div>
</div>

<style>
    .jqstooltip {
        max-width: none !important;
        width: auto !important;
        font-size: 12px; /* Adjust as needed */
        padding: 5px; /* Adjust as needed */
    }
</style>

<script type="text/javascript">
    function getRandomColor() {
        var letters = '01234567'; // Limiting to darker colors
        var color = '#';
        for (var i = 0; i < 3; i++) {
            var part = letters[Math.floor(Math.random() * 8)];
            color += part + part; // Repeat the hex digit to lower brightness
        }
        return color;
    }

    jQuery(document).ready(function($) {
        var bodyPartCounts = @json($killsBodyPartChart);
        var bodyPartData = bodyPartCounts.map(item => item.count);
        var bodyPartNames = bodyPartCounts.map(item => item.body_part);

        // Generate random colors for each slice
        var sliceColors = bodyPartData.map(() => getRandomColor());

        $(".pie-body-part-kills").sparkline(bodyPartData, {
            type: 'pie',
            width: '150px',
            height: '150px',
            sliceColors: sliceColors,
            tooltipFormatter: function(sparkline, options, fields) {
                return bodyPartNames[fields.offset] + ": " + fields.value;
            },
        });
    });
</script>
