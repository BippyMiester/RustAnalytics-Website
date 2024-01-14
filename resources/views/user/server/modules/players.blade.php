<div class="tab-pane" id="v-players">
    <div class="row">
        <div class="col-sm-12">
            <table class="table table-sm table-hover table-borderless">
                <thead>
                <tr>
                    <th>Steam ID</th>
                    <th>Username</th>
                    <th>IP Address</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($players as $player)
                    <tr>
                        <th>
                            <a href="https://www.steamidfinder.com/lookup/{{ $player->steam_id }}/" target="_blank"><strong>{{ $player->steam_id }}</strong></a>
                        </th>
                        <td>{{ $player->username }}</td>
                        <td>{{ $player->ip_address }}</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-info">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
