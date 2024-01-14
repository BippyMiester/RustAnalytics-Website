@extends('layouts.app')

@section('title', 'Home')

@section('content')

    @include('modules.app.hero')

    @include('modules.app.promo')

{{--    @include('modules.app.features')--}}

    @include('modules.app.installProcess')

    @include('modules.app.pricing')

    @include('modules.app.faq')

    @include('modules.app.reviews')

    @include('modules.app.contact')

@endsection
