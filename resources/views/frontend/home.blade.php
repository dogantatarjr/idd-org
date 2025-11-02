@extends('frontend.master')

@section('title', 'İklim Değişmeden Değiş (IDD ORG)')

@section('home-sit', 'active')

@section('content')
    @include('frontend.partials.slider')

    @include('frontend.partials.about')

    @include('frontend.partials.blog')

    @include('frontend.partials.stats')

    @include('frontend.partials.teams')
@endsection
