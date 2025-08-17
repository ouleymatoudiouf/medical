@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md mt-8">

    <h2 class="text-3xl font-bold mb-6 text-gray-800 dark:text-gray-100">Créer un nouvel utilisateur</h2>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    @if($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('admin.store-user') }}" class="space-y-4">
        @csrf

        <!-- Nom -->
        <div>
            <label for="name" class="block text-gray-700 dark:text-gray-200 font-medium mb-1">Nom</label>
            <input type="text" name="name" id="name" class="w-full px-4 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-200" required value="{{ old('name') }}">
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-gray-700 dark:text-gray-200 font-medium mb-1">Email</label>
            <input type="email" name="email" id="email" class="w-full px-4 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-200" required value="{{ old('email') }}">
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-gray-700 dark:text-gray-200 font-medium mb-1">Mot de passe</label>
            <input type="password" name="password" id="password" class="w-full px-4 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-200" required>
        </div>

        <!-- Confirmation du mot de passe -->
        <div>
            <label for="password_confirmation" class="block text-gray-700 dark:text-gray-200 font-medium mb-1">Confirmer le mot de passe</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="w-full px-4 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-200" required>
        </div>

        <!-- Rôle -->
        <div>
            <label for="role" class="block text-gray-700 dark:text-gray-200 font-medium mb-1">Rôle</label>
            <select name="role" id="role" class="w-full px-4 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-200" required>
                <option value="doctor" {{ old('role') == 'doctor' ? 'selected' : '' }}>Médecin</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>

        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-md transition">Créer utilisateur</button>
    </form>
</div>
@endsection
