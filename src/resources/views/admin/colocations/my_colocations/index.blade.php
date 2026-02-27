@extends('admin.layout')

@section('content')
    <h1 class="text-2xl font-bold mb-6 text-gray-800">
        Mes Colocations
    </h1>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Nom</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Owner</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Statut</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 bg-white">
                @forelse($colocations as $coloc)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-medium text-blue-600">
                            <a href="{{ route('colocation.dashboard', $coloc->id) }}"
                                class="text-blue-600 font-semibold hover:underline">
                                {{ $coloc->name }}
                            </a>
                        </td>
                        <td class="px-6 py-4">
                            {{ $coloc->owner->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $coloc->status }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-gray-500">
                            Aucune colocation trouvée.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
