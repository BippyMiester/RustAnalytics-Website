<div class="tab-pane active" id="v-information">
    <div class="row">
        <div class="col-sm-6">
            <table class="table table-borderless">
                <tbody>
                <tr>
                    <td>Server Name</td>
                    <td>{{ $server->name }}</td>
                </tr>
                <tr>
                    <td>Public Slug</td>
                    <td>{{ $server->slug }}</td>
                </tr>
                <tr>
                    <td>API Key</td>
                    <td>{{ $server->api_key }}</td>
                </tr>
                <tr>
                    <td>IP Address</td>
                    <td>{{ $server->ip_address }}</td>
                </tr>
                <tr>
                    <td>Port</td>
                    <td>{{ $server->port }}</td>
                </tr>
                <tr>
                    <td>Protocol</td>
                    <td>{{ $server->protocol }}</td>
                </tr>
                <tr>
                    <td>World Seed</td>
                    <td>{{ $server->world_seed }}</td>
                </tr>
                <tr>
                    <td>World Size</td>
                    <td>{{ $server->map_size }} km</td>
                </tr>
                <tr>
                    <td>World Name</td>
                    <td>{{ $server->world_name }}</td>
                </tr>
                <tr>
                    <td>Last Wiped</td>
                    <td>{{ $server->last_wiped }}</td>
                </tr>
                <tr>
                    <td>Last Blueprint Wipe</td>
                    <td>{{ $server->blueprint_last_wiped }}</td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td>{{ $server->description }}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-sm-6">
            <h2 style="margin-top: 0;">What To Do With This Data</h2>
            <p>This information is currently being gathered whenever your server first starts up. It is automatically populated based on your server settings and configuration. This is also where you get your api_key for the plugin.</p>
            <div class="row">
                <div class="col-sm-6">
                    <div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->
                        <!-- panel head -->
                        <div class="panel-heading">
                            <div class="panel-title">Server FPS</div>
                        </div>

                        <!-- panel body -->
                        <div class="panel-body">
                            <div class="text-center">
                                <span class="line-server-fps-waiting">Waiting For Server To Give Us Data. Is it offline?</span>
                                <div class="line-server-fps-wrapper" style="display: none;">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            Current Server FPS: <span class="currentServerFPS"></span>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="chart-container">
                                                <div class="y-axis">
                                                    <!-- Generate labels based on your chart range -->
                                                    <div>240</div> <!-- Replace these with dynamic values as needed -->
                                                    <div>210</div> <!-- Replace these with dynamic values as needed -->
                                                    <div>180</div> <!-- Replace these with dynamic values as needed -->
                                                    <div>150</div> <!-- Replace these with dynamic values as needed -->
                                                    <div>120</div> <!-- Replace these with dynamic values as needed -->
                                                    <div>90</div>
                                                    <div>60</div>
                                                    <div>30</div>
                                                    <div>0</div>
                                                </div>
                                                <div id="serverFpsLineGraph"></div>
                                            </div>
                                            <span id="serverFpsLineGraph"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->
                        <!-- panel head -->
                        <div class="panel-heading">
                            <div class="panel-title">Server Entities</div>
                        </div>

                        <!-- panel body -->
                        <div class="panel-body">
                            <div class="text-center">
                                <span class="line-server-entities-waiting">Waiting For Server To Give Us Data. Is it offline?</span>
                                <div class="line-server-entities-wrapper" style="display: none;">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            Current Server Entities: <span class="currentServerEntities"></span>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="chart-container">
                                                <div class="y-axis">
                                                    <!-- Generate labels based on your chart range -->
                                                    <div>500,000</div> <!-- Replace these with dynamic values as needed -->
                                                    <div>400,000</div> <!-- Replace these with dynamic values as needed -->
                                                    <div>300,000</div> <!-- Replace these with dynamic values as needed -->
                                                    <div>200,000</div> <!-- Replace these with dynamic values as needed -->
                                                    <div>100,000</div> <!-- Replace these with dynamic values as needed -->
                                                    <div>0</div>
                                                </div>
                                                <div id="serverEntitiesLineGraph"></div>
                                            </div>
                                            <span id="serverEntitiesLineGraph"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="tile-stats tile-aqua">
                        <div class="icon"><i class="fa-solid fa-memory"></i></div>
                        <div class="num" id="server-memory-usage" style="font-size: 1.5em;">Waiting For Refresh...</div>

                        <h3>Memory</h3>
                        <p>currently being used</p>
                    </div>

                    <div class="tile-stats tile-aqua">
                        <div class="icon"><i class="fa-solid fa-globe"></i></div>
                        <div class="num" id="server-network-usage" style="font-size: 1.5em;">Waiting For Refresh...</div>

                        <h3>Network</h3>
                        <p>In/Out Usage</p>
                    </div>

                    <div class="tile-stats tile-aqua">
                        <div class="icon"><i class="fa-regular fa-clock"></i></div>
                        <div class="num" id="server-ingame-time" style="font-size: 1.5em;">Waiting For Refresh...</div>

                        <h3>Time</h3>
                        <p>Inside The Game</p>
                    </div>

                    <div class="tile-stats tile-aqua">
                        <div class="icon"><i class="fa-solid fa-users"></i></div>
                        <div class="num" id="server-players-online" style="font-size: 1.5em;">Waiting For Refresh...</div>

                        <h3>Players</h3>
                        <p>Connected To Your Server</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .chart-container {
        display: flex;
        align-items: flex-end;
    }
    .y-axis {
        display: flex;
        flex-direction: column;
        height: 200px; /* Match the height of your Sparkline chart */
        justify-content: space-between;
        padding-right: 10px; /* Spacing between labels and chart */
    }
    #serverFpsLineGraph, #serverEntitiesLineGraph {
        width: 100%;
        height: 200px;
    }
</style>

<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('f2cbd1e30b9474b0073f', {
        cluster: 'us2'
    });

    var channel = pusher.subscribe('server-panel-update.{{ $server->slug }}');
    var firstEventReceived = false; // Flag to check if the first event is received

    channel.bind('server-data-update', function(data) {
        // Ensure that serverData exists and is an array
        if (data.serverData && Array.isArray(data.serverData) && data.serverData.length > 0) {
            var mostRecentData = data.serverData[0];

            // Get the most current FPS
            var currentFps = mostRecentData.server_fps;
            var currentEntities = mostRecentData.entities;

            // Update the currentServerFPS span with the current server_fps value
            $('.currentServerFPS').text(currentFps);
            $('.currentServerEntities').text(currentEntities);

            // Hide the 'Waiting For Server To Give Us Data. Is it offline?' span on the first event
            if (!firstEventReceived) {
                $('.line-server-fps-waiting').hide();
                $('.line-server-entities-waiting').hide();
                $('.line-server-fps-wrapper').css('display', 'flex');
                $('.line-server-entities-wrapper').css('display', 'flex');
                firstEventReceived = true; // Set the flag to true after the first event
            }

            // Extract memory usage values
            var currentMemory = mostRecentData.used_memory;
            var maxMemory = mostRecentData.max_memory;

            // Update the server-memory-usage div with the current and max memory values
            $('#server-memory-usage').text(currentMemory + 'Gb / ' + maxMemory + 'Gb');

            // Extract network usage values
            var networkIn = mostRecentData.network_in;
            var networkOut = mostRecentData.network_out;

            // Update the server-network-usage div with the network in and out values
            $('#server-network-usage').text(networkIn + 'kb / ' + networkOut + 'kb');

            // Extract the most current in-game time
            var inGameTime = mostRecentData.in_game_time;

            // Update the server-ingame-time div with the most current in-game time
            $('#server-ingame-time').text(inGameTime);

            // Extract players online and max players values
            var playersOnline = mostRecentData.players_online;
            var maxPlayers = mostRecentData.players_max;

            // Update the server-players-online div with the players online and max players values
            $('#server-players-online').text(playersOnline + ' / ' + maxPlayers);

            // Extract server_fps values from the data
            var fpsValues = data.serverData.map(function(item) {
                return item.server_fps;
            }).reverse();

            // Extract the entities values from the data
            var entitiesValues = data.serverData.map(function(item) {
                return item.entities;
            }).reverse();

            // Render the Sparkline line graph
            $('#serverFpsLineGraph').sparkline(fpsValues, {
                type: 'line',
                width: '100%',
                height: '200px',
                lineColor: '#0066cc',
                fillColor: '#cceeff',
                spotColor: '#0077cc',
                minSpotColor: '#f44',
                maxSpotColor: '#4f4',
                highlightSpotColor: '#f44',
                highlightLineColor: '#f44',
                chartRangeMin: 0,
                chartRangeMax: 240,
                normalRangeMin: 0,
                normalRangeMax: 240,
                yAxis: {
                    minInterval: 10, // Markers at intervals of 10
                }
            });

            // Render the Sparkline line graph
            $('#serverEntitiesLineGraph').sparkline(entitiesValues, {
                type: 'line',
                width: '100%',
                height: '200px',
                lineColor: '#0066cc',
                fillColor: '#cceeff',
                spotColor: '#0077cc',
                minSpotColor: '#f44',
                maxSpotColor: '#4f4',
                highlightSpotColor: '#f44',
                highlightLineColor: '#f44',
                chartRangeMin: 0,
                chartRangeMax: 500000,
                normalRangeMin: 0,
                normalRangeMax: 500000,
                yAxis: {
                    minInterval: 10, // Markers at intervals of 10
                }
            });
        } else {
            console.log("serverData is undefined or not an array");
        }
    });
</script>
