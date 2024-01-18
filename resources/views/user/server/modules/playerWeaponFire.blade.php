<div class="tab-pane" id="v-playerWeaponFire">
    <div class="row">
        <div class="row">
            <div class="col-sm-3">
                <div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->
                    <!-- panel head -->
                    <div class="panel-heading">
                        <div class="panel-title">Top Bullets Fired</div>
                    </div>

                    <!-- panel body -->
                    <div class="panel-body">
                        @foreach ($topBulletsFired as $player)
                            <p><strong>{{ $player['username'] }}</strong> - {{ $player['total_bullets'] }}</p>
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
                        @foreach ($topWeaponBulletsFired as $weapon)
                            <p><strong>{{ $weapon['weapon'] }}</strong> - {{ $weapon['total_bullets'] }}</p>
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
                    <th>Bullet</th>
                    <th>Weapon</th>
                    <th>Amount</th>
                    <th>Time</th>
                </tr>
                </thead>
                <tbody>
                @foreach($weaponFire as $bullet)
                    <tr>
                        <th>
                            <a href="https://www.steamidfinder.com/lookup/{{ $bullet->steam_id }}/" target="_blank"><strong>{{ $bullet->steam_id }}</strong></a>
                        </th>
                        <td>{{ $bullet->username }}</td>
                        <td>{{ $bullet->bullet }}</td>
                        <td>{{ $bullet->weapon }}</td>
                        <td>{{ $bullet->amount }}</td>
                        <td>{{ $bullet->created_at->format('H:i:s | m-d-y') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="text-center">
                <!-- Pagination Links -->
                {{ $weaponFire->appends(['weaponFirePage' => $weaponFire->currentPage(), 'killsPage' => Request::get('killsPage'), 'deathsPage' => Request::input('deathsPage'), 'gatherPage' => Request::input('gatherPage')])->links('pagination::bootstrap-4') }}
            </div>
        </div>

    </div>
</div>
