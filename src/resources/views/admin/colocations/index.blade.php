@extends('admin.layout')

@section('content')
<h1 class="text-2xl font-bold mb-6 text-gray-800">Liste des colocations</h1>

<table class="min-w-full divide-y divide-gray-200 bg-white shadow rounded-lg">
    <thead class="bg-gray-800 text-white">
        <tr>
            <th class="px-6 py-3 text-left text-sm font-semibold">Nom</th>
            <th class="px-6 py-3 text-left text-sm font-semibold">status</th>
            <th class="px-6 py-3 text-left text-sm font-semibold">owner</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200 bg-white">
        @foreach($colocations as $colocation)
        <tr class="hover:bg-gray-50 transition">
            <td class="px-6 py-4">{{ $colocation->name }}</td>
            <td class="px-6 py-4">{{ $colocation->status }}</td>
            <td class="px-6 py-4">{{ $colocation->owner->name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
