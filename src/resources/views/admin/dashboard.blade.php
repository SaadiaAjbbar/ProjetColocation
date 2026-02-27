@extends('admin.layout')

@section('content')
    <h1 class="text-2xl font-bold mb-6 text-gray-800">
        Statistiques Globales
    </h1>
    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif


    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">

        <a href="{{ route('admin.users.index') }}" class="block bg-white shadow rounded-lg p-6 hover:bg-gray-50 transition">
            <p class="text-gray-500 text-sm">Utilisateurs</p>
            <p class="text-2xl font-bold text-blue-600">
                {{ $stats['total_users'] }}
            </p>
        </a>

        <a href="{{ route('admin.colocations.store') }}"
            class="block bg-white shadow rounded-lg p-6 hover:bg-gray-50 transition">
            <p class="text-gray-500 text-sm">Colocations</p>
            <p class="text-2xl font-bold text-green-600">
                {{ $stats['total_colocations'] }}
            </p>
        </a>

        <div class="bg-white shadow rounded-lg p-6">
            <p class="text-gray-500 text-sm">Dépenses</p>
            <p class="text-2xl font-bold text-purple-600">
                {{ $stats['total_depenses'] }}
            </p>
        </div>

        <a href="{{ route('admin.users.banned') }}"
            class="block bg-white shadow rounded-lg p-6 hover:bg-gray-50 transition">
            <p class="text-gray-500 text-sm">Utilisateurs bannis</p>
            <p class="text-2xl font-bold text-red-600">
                {{ $stats['banned_users'] }}
            </p>
        </a>

    </div>

    <!-- Colocations Table -->
    <h2 class="text-xl font-semibold mb-4 text-gray-800">
        Liste des Colocations
    </h2>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Nom</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Owner</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Membres</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Status</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 bg-white">
                @foreach ($colocations as $coloc)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">{{ $coloc->name }}</td>
                        <td class="px-6 py-4">{{ $coloc->owner->name }}</td>
                        <td class="px-6 py-4">{{ $coloc->adhesions->count() }}</td>
                        <td class="px-6 py-4">
                            <span
                                class="px-3 py-1 rounded-full text-xs font-semibold
                        {{ $coloc->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-600' }}">
                                {{ $coloc->status }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
