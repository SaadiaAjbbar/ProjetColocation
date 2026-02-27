@extends('admin.layout')

@section('content')
<h1 class="text-2xl font-bold mb-6 text-gray-800">Liste des Utilisateurs</h1>

<table class="min-w-full divide-y divide-gray-200 bg-white shadow rounded-lg">
    <thead class="bg-gray-800 text-white">
        <tr>
            <th class="px-6 py-3 text-left text-sm font-semibold">Nom</th>
            <th class="px-6 py-3 text-left text-sm font-semibold">Email</th>
            <th class="px-6 py-3 text-left text-sm font-semibold">Rôle</th>
            <th class="px-6 py-3 text-left text-sm font-semibold">Banni</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200 bg-white">
        @foreach($users as $user)
        <tr class="hover:bg-gray-50 transition">
            <td class="px-6 py-4">{{ $user->name }}</td>
            <td class="px-6 py-4">{{ $user->email }}</td>
            <td class="px-6 py-4">{{ $user->role }}</td>
            <td class="px-6 py-4">
                {{ $user->is_banned ? 'Oui' : 'Non' }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
