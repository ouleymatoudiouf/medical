@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Tableau de Bord - Administrateur</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between mb-3">
        <p>Bienvenue, <strong>{{ auth()->user()->name }}</strong></p>
        <a href="{{ route('admin.create-user') }}" class="btn btn-primary">+ Ajouter un utilisateur</a>
    </div>

    <hr>

    <h4 class="mb-3">Liste des Utilisateurs (Admins & Médecins)</h4>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Rôle</th>
            <th>Date d'inscription</th>
        </tr>
        </thead>
        <tbody>
        @forelse($users as $index => $user)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                @foreach($user->getRoleNames() as $role)
                @if($role === 'admin')
                <span class="badge bg-danger">Admin</span>
                @elseif($role === 'doctor')
                <span class="badge bg-success">Médecin</span>
                @else
                <span class="badge bg-secondary">{{ ucfirst($role) }}</span>
                @endif
                @endforeach
            </td>
            <td>{{ $user->created_at->format('d/m/Y') }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center">Aucun utilisateur trouvé</td>
        </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
