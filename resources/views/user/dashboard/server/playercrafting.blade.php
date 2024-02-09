@extends('layouts.dashboard2')

@section('title', $server->name . ' - Player Crafting')

@section('breadcrumbs')
    <li class="breadcrumb-item">Servers</li>
    <li class="breadcrumb-item"><a href="{{ route('user.dashboard.server.show', $server->slug) }}">{{ \Illuminate\Support\Str::limit($server->name, 30) }}</a></li>
    <li class="breadcrumb-item active">Player Crafting</li>
@endsection

@section('content')

    <!-- Begin Cards Row -->
    <div class="row">
        <div class="col-sm-3">
            <div class="card mb-3">
                <!-- BEGIN card-body -->
                <div class="card-body">
                    <!-- BEGIN title -->
                    <div class="d-flex fw-bold mb-3">
                        <span class="flex-grow-1">Top Crafted Items</span>
                        {{--                        <a href="#" data-toggle="card-expand" class="text-inverse text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>--}}
                    </div>
                    <!-- END title -->
                    <!-- BEGIN stat-lg -->
                    <div class="row align-items-center mb-2">
                        <div class="col-12">
                            <p>
                                @foreach ($topCraftedItems as $item)
                                    <strong>{{ $item->item_crafted }}</strong> - {{ $item->total_crafted }} <br>
                                @endforeach
                            </p>
                        </div>
                    </div>
                    <!-- END stat-lg -->
                </div>
                <!-- END card-body -->

                <!-- BEGIN card-arrow -->
                <div class="card-arrow">
                    <div class="card-arrow-top-left"></div>
                    <div class="card-arrow-top-right"></div>
                    <div class="card-arrow-bottom-left"></div>
                    <div class="card-arrow-bottom-right"></div>
                </div>
                <!-- END card-arrow -->
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card mb-3">
                <!-- BEGIN card-body -->
                <div class="card-body">
                    <!-- BEGIN title -->
                    <div class="d-flex fw-bold mb-3">
                        <span class="flex-grow-1">Top Players by Crafted Items</span>
                        {{--                        <a href="#" data-toggle="card-expand" class="text-inverse text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>--}}
                    </div>
                    <!-- END title -->
                    <!-- BEGIN stat-lg -->
                    <div class="row align-items-center mb-2">
                        <div class="col-12">
                            <p>
                                @foreach ($topCraftersBySteamID as $crafter)
                                    <strong>{{ $crafter->username }}</strong> - {{ $crafter->total_crafted }} Items Crafted <br>
                                @endforeach
                            </p>
                        </div>
                    </div>
                    <!-- END stat-lg -->
                </div>
                <!-- END card-body -->

                <!-- BEGIN card-arrow -->
                <div class="card-arrow">
                    <div class="card-arrow-top-left"></div>
                    <div class="card-arrow-top-right"></div>
                    <div class="card-arrow-bottom-left"></div>
                    <div class="card-arrow-bottom-right"></div>
                </div>
                <!-- END card-arrow -->
            </div>
        </div>
    </div>
    <!-- End Cards Row -->

    <!-- Start Data Cards -->
    <div class="row">
        <div class="col-sm-12">
            <table class="table table-sm table-hover table-borderless">
                <thead>
                <tr>
                    <th>Steam ID</th>
                    <th>Username</th>
                    <th>Item Crafted</th>
                    <th>Amount</th>
                    <th>Time</th>
                </tr>
                </thead>
                <tbody>
                @foreach($playerCrafting as $craftedItem)
                    <tr>
                        <th>
                            <a href="https://www.steamidfinder.com/lookup/{{ $craftedItem->steam_id }}/" target="_blank"><strong>{{ $craftedItem->steam_id }}</strong></a>
                        </th>
                        <td>{{ $craftedItem->username }}</td>
                        <td>{{ $craftedItem->item_crafted }}</td>
                        <td>{{ $craftedItem->amount }}</td>
                        <td>{{ $craftedItem->created_at->format('H:i:s | m-d-y') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                <!-- Pagination Links -->
                {{ $playerCrafting->links('pagination::bootstrap-4') }}
            </div>
        </div>

    </div>
    <!-- End Data Cards -->
@endsection
