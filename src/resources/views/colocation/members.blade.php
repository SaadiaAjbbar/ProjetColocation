@extends('layout')

@section('content')

<h1 class="text-2xl font-bold mb-6">
    Membres de {{ $colocation->name }}
</h1>

<div class="bg-white rounded-2xl shadow-sm border border-gray-200">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nom</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Rôle</th>
            </tr>
        </thead>

        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($members as $member)
                <tr>
                    <td class="px-6 py-4">
                        {{ $member->user->name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $member->user->email }}
                    </td>
                    <td class="px-6 py-4">
                        @if($member->role === 'owner')
                            <span class="px-2 py-1 text-xs font-semibold bg-emerald-100 text-emerald-700 rounded-full">
                                Owner
                            </span>
                        @else
                            <span class="px-2 py-1 text-xs font-semibold bg-blue-100 text-blue-700 rounded-full">
                                Member
                            </span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
