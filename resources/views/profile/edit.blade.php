@extends('layouts.app')

@section('pageTitle')
    Editar perfil
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/generic.css') }}">
    <link rel="stylesheet" href="{{ asset('css/section.css') }}">
@endpush

@section('content')
    <x-menu-component />
    @include('profile.partials.update-profile-information-form')
    @include('profile.partials.update-password-form')
@endsection