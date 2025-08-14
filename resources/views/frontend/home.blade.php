@extends('frontend.master')

@section('title', 'İklim Değişmeden Değiş')

@section('home-sit', 'active')

@section('content')
    @include('frontend.partials.slider')

    @include('frontend.partials.about')

    @include('frontend.partials.stats')

    @include('frontend.partials.teams')
@endsection
