<div class="tab-pane" id="v-playerGather">
    <div class="row">
        <div class="col-sm-3">
            <div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->
                <!-- panel head -->
                <div class="panel-heading">
                    <div class="panel-title">Total Collected Resources</div>
                </div>

                <!-- panel body -->
                <div class="panel-body">
                    @foreach ($totalAmountsByResource as $resource => $amount)
                        <p>{{ $resource }}: {{ $amount }}</p>
                    @endforeach
                    <div class="text-center">
                        <span class="pie-large"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->
                <!-- panel head -->
                <div class="panel-heading">
                    <div class="panel-title">Top Collectors</div>
                </div>

                <!-- panel body -->
                <div class="panel-body">
                    @foreach ($topCollectors as $resource => $collectorInfo)
                        <div>
                            <p>{{ $resource }} - {{ $collectorInfo['username'] }} - {{ $collectorInfo['amount'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <h3>Raw Data</h3>
            <table class="table table-sm table-hover table-borderless">
                <thead>
                <tr>
                    <th>Steam ID</th>
                    <th>Username</th>
                    <th>Resource</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($playerGather as $item)
                    <tr>
                        <th>
                            <a href="https://www.steamidfinder.com/lookup/{{ $item['steam_id'] }}/" target="_blank"><strong>{{ $item['steam_id'] }}</strong></a>
                        </th>
                        <td>{{ $item['username'] }}</td>
                        <td>{{ $item['resource'] }}</td>
                        <td>{{ $item['total_amount'] }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="text-center">
                <!-- Pagination Links -->
                {{ $playerGather->appends(['gatherPage' => $playerGather->currentPage(), 'killsPage' => Request::get('killsPage')])->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var totalAmountsByResource = @json($totalAmountsByResource);

    function getRandomColor() {
        var letters = '01234567'; // Limiting to darker colors
        var color = '#';
        for (var i = 0; i < 3; i++) {
            var part = letters[Math.floor(Math.random() * 8)];
            color += part + part; // Repeat the hex digit to lower brightness
        }
        return color;
    }

    jQuery(document).ready(function($)
    {
        var totalAmountsByResource = @json($totalAmountsByResource);
        var data = Object.values(totalAmountsByResource);
        var resourceNames = Object.keys(totalAmountsByResource);

        // Generate random colors for each slice
        var sliceColors = data.map(() => getRandomColor());

        $(".pie-large").sparkline(data, {
            type: 'pie',
            width: '150px',
            height: '150px',
            sliceColors: sliceColors,
            tooltipFormatter: function(sparkline, options, fields) {
                return resourceNames[fields.offset] + ": " + fields.value;
            }
        });
    });
</script>
