<!-- resources/views/patient/dashboard.blade.php -->

@extends('layouts.app')

@section('title', 'Dashboard Patient')

@section('content')
<div class="container mt-5">
    <h1>Bienvenue {{ auth()->user()->name }}</h1>
    <p>Vous êtes connecté en tant que <strong>Patient</strong>.</p>

    <a href="{{ route('logout') }}"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
       class="btn btn-danger">
        Déconnexion
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</div>
@endsection
