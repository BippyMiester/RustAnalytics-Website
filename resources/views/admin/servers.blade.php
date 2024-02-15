@extends('layouts.dashboard2')

@section('title', 'Servers Index')

@section('content')

    <!-- Begin Cards Row -->
    <div class="row">
        <div class="col-sm-3">
            <div class="card mb-3">
                <!-- BEGIN card-body -->
                <div class="card-body">
                    <!-- BEGIN title -->
                    <div class="d-flex fw-bold small mb-3">
                        <span class="flex-grow-1"><i class="fa-solid fa-server"></i> Total Servers</span>
                        <a href="#" data-toggle="card-expand" class="text-inverse text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
                    </div>
                    <!-- END title -->
                    <!-- BEGIN stat-lg -->
                    <div class="row align-items-center mb-2">
                        <div class="col-12">
                            <h3 class="mb-0">{{ $serversCount }} Servers</h3>
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

    <div class="row justify-content-center">
        <div class="col-sm-12 text-center">
            <table class="table table-sm table-hover table-borderless">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>IP Address</th>
                    <th>Protocol</th>
                    <th>Owner</th>
                    <th>Plugin Version</th>
                    <th>Refresh Rate</th>
                    <th>Players Online</th>
                    <th>Created Time</th>
                    <th>Last Server Data</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($adminServers as $server)
                    <tr>
                        <td>{{ $server->name }}</td>
                        <td>{{ $server->ip_address }}</td>
                        <td>{{ $server->protocol }}</td>
                        <td>{{ $server->user->username }}</td>
                        <td>{{ $server->version }}</td>
                        <td>{{ $server->refresh_rate }}</td>
                        <td>{{ $server->serverdata->sortByDesc('created_at')->first()->players_online ?? 'N/A' }}</td>
                        <td>{{ $server->created_at->format('H:i:s | m-d-y') }}</td>
                        <td>{{ optional($server->serverdata->sortByDesc('created_at')->first())->created_at ?? 'N/A' }}</td>
                        <td>
                            <form action="{{ route('admin.forcelogin.login') }}" method="POST">
                                @csrf {{-- CSRF token protection --}}
                                <input type="hidden" name="user_id" value="{{ $server->user->id }}"> {{-- Pass the user ID --}}
                                <button type="submit" class="btn btn-sm btn-primary">
                                    <i class="fa-solid fa-right-to-bracket"></i> Login
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                <!-- Pagination Links -->
                {{ $adminServers->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>



@endsection
