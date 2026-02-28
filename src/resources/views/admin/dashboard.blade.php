@extends('admin.layout')

@section('content')

    @if (session('success'))
        <div
            class="mb-6 flex items-center p-4 text-emerald-700 bg-emerald-50 border-l-4 border-emerald-500 rounded-r-lg shadow-sm">
            <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                    clip-rule="evenodd"></path>
            </svg>
            <span class="text-sm font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <a href="{{ route('admin.users.index') }}"
            class="group bg-white border border-gray-200 rounded-2xl p-6 shadow-sm hover:border-blue-500 hover:shadow-md transition-all duration-300">

            <p class="text-3xl font-black text-gray-900">{{ number_format($stats['total_users']) }}</p>
            <p class="text-sm text-gray-500 font-medium">Utilisateurs</p>
        </a>

        <div
            class="group bg-white border border-gray-200 rounded-2xl p-6 shadow-sm hover:border-emerald-500 hover:shadow-md transition-all duration-300">

            <p class="text-3xl font-black text-gray-900">{{ number_format($stats['total_colocations']) }}</p>
            <p class="text-sm text-gray-500 font-medium">colocations</p>
        </div>

        <div
            class="group bg-white border border-gray-200 rounded-2xl p-6 shadow-sm hover:border-purple-500 hover:shadow-md transition-all duration-300">

            <p class="text-3xl font-black text-gray-900">{{ number_format($stats['total_depenses']) }}</p>
            <p class="text-sm text-gray-500 font-medium">Dépenses</p>
        </div>

        <a href="{{ route('admin.users.banned') }}"
            class="group bg-white border border-gray-200 rounded-2xl p-6 shadow-sm hover:border-red-500 hover:shadow-md transition-all duration-300">

            <p class="text-3xl font-black text-gray-900">{{ $stats['banned_users'] }}</p>
            <p class="text-sm text-gray-500 font-medium">Comptes bannis</p>
        </a>
    </div>

    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
            Liste des Colocations
        </h2>
    </div>

    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Nom & ID</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Responsable
                        (Owner)</th>
                    <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Occupation
                    </th>
                    <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">État</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 bg-white">
                @foreach ($colocations as $coloc)
                    <tr class="hover:bg-slate-50 transition-colors group">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-bold text-gray-900">{{ $coloc->name }}</div>
                            <div class="text-[10px] text-gray-400 font-mono">ID: {{ substr($coloc->id, 0, 8) }}...</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <div
                                    class="w-7 h-7 bg-slate-100 rounded-full flex items-center justify-center text-[10px] font-bold text-slate-600 border border-slate-200">
                                    {{ substr($coloc->owner->name, 0, 1) }}
                                </div>
                                <span class="text-sm text-gray-700 font-medium">{{ $coloc->owner->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div
                                class="inline-flex items-center px-2.5 py-1 rounded-md bg-gray-100 text-gray-700 text-xs font-bold">
                                {{ $coloc->adhesions->count() }} membres
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if ($coloc->status === 'active')
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">
                                    <span class="w-1.5 h-1.5 mr-1.5 rounded-full bg-emerald-500"></span>
                                    Active
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-slate-100 text-slate-500">
                                    Archivée
                                </span>
                            @endif
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
