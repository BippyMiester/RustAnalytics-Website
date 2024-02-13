@extends('layouts.dashboard2')

@section('title', 'Force Login')

@section('content')

    <!-- Begin Cards Row -->
    <div class="row">
        <div class="col-sm-3">
            <div class="card mb-3">
                <!-- BEGIN card-body -->
                <div class="card-body">
                    <!-- BEGIN title -->
                    <div class="d-flex fw-bold small mb-3">
                        <span class="flex-grow-1"><i class="fa-solid fa-users"></i> Total Users</span>
                        <a href="#" data-toggle="card-expand" class="text-inverse text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
                    </div>
                    <!-- END title -->
                    <!-- BEGIN stat-lg -->
                    <div class="row align-items-center mb-2">
                        <div class="col-12">
                            <h3 class="mb-0">{{ $users->count() }} Users</h3>
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
                    <th></th>
                    <th>Username</th>
                    <th>Provider</th>
                    <th>Provider ID</th>
                    <th>eMail</th>
                    <th>Locale</th>
                    <th>Created Time</th>
                    <th>Last Login</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <th>
                            <img src="{{ $user->avatar }}" alt="{{ $user->username }}'s Avatar" class="w-25">
                        </th>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->provider }}</td>
                        <td>{{ $user->provider_id }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->locale }}</td>
                        <td>{{ $user->created_at->format('H:i:s | m-d-y') }}</td>
                        <td>{{ $user->updated_at->format('H:i:s | m-d-y') }}</td>
                        <td>
                            <form action="{{ route('admin.forcelogin.login') }}" method="POST">
                                @csrf {{-- CSRF token protection --}}
                                <input type="hidden" name="user_id" value="{{ $user->id }}"> {{-- Pass the user ID --}}
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
                {{ $users->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>



@endsection
