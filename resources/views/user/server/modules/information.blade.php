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
        </div>
    </div>
</div>
