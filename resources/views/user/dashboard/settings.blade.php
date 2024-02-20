@extends('layouts.dashboard2')

@section('title', 'User Settings')

@section('breadcrumbs')
    <li class="breadcrumb-item active">Settings</li>
@endsection

@section('content')
    <form action="{{ route('user.profile.settingsPOST') }}" method="POST" class="needs-validation" novalidate>
    @csrf <!-- CSRF Token for form security -->
        <div class="row justify-content-center">
                <div class="col-sm-4">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control bg-secondary" id="username" name="username" value="{{ $user->username }}" disabled required>
                        <div class="invalid-feedback">
                            Please provide a username.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="provider_id" class="form-label">Provider ID</label>
                        <input type="text" class="form-control bg-secondary" id="provider_id" name="provider_id" value="{{ $user->provider_id }}" disabled required>
                        <div class="invalid-feedback">
                            Please provide a provider ID.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">News Notifications</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="news_notifications" id="news_notifications_true" value="1" {{ $user->news_notifications ? 'checked' : '' }}>
                            <label class="form-check-label" for="news_notifications_true">
                                Yes
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="news_notifications" id="news_notifications_false" value="0" {{ !$user->news_notifications ? 'checked' : '' }}>
                            <label class="form-check-label" for="news_notifications_false">
                                No
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="mb-3">
                        <label for="email" class="form-label">eMail <span class="text-red">*</span></label>
                        <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                        <div class="invalid-feedback">
                            Please provide a eMail address.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="tos_accept_date" class="form-label">ToS Accept Date</label>
                        <input type="text" class="form-control bg-secondary" id="tos_accept_date" name="tos_accept_date" value="{{ $user->tos_accept_date }}" disabled required>
                    </div>

                    <div class="mb-3">
                        <label for="privacy_accept_date" class="form-label">Privacy Accept Date</label>
                        <input type="text" class="form-control bg-secondary" id="privacy_accept_date" name="privacy_accept_date" value="{{ $user->privacy_accept_date }}" disabled required>
                    </div>
                </div>

                <div class="col-sm-6 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

        </div>
    </form>


@endsection
