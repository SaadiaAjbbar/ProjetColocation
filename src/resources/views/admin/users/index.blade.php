@extends('admin.layout')

@section('content')
    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 tracking-tight">liste des Utilisateurs</h1>
            <p class="text-sm text-gray-500 mt-1">Gérez les accès, modifiez les rôles et appliquez les sanctions.</p>
        </div>

        <div
            class="flex items-center gap-2 bg-white border border-gray-200 p-1.5 rounded-xl shadow-sm focus-within:ring-2 focus-within:ring-blue-500 transition-all">
            <svg class="w-5 h-5 text-gray-400 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            <input type="text" placeholder="Rechercher un membre..."
                class="px-2 py-1 text-sm outline-none bg-transparent w-64 text-gray-700">
        </div>
    </div>

    @if (session('success'))
        <div
            class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 text-sm font-medium rounded-r-lg animate-fade-in">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Profil</th>
                        <th scope="col"
                            class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Rôle</th>
                        <th scope="col"
                            class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">État</th>
                        <th scope="col"
                            class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @foreach ($users as $user)
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div
                                        class="h-10 w-10 flex-shrink-0 rounded-full bg-gradient-to-br from-slate-100 to-slate-200 border border-gray-200 flex items-center justify-center text-slate-500 font-bold shadow-sm">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-semibold text-gray-900">{{ $user->name }}</div>
                                        <div class="text-xs text-gray-500 font-mono">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($user->role === 'admin')
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-md text-[10px] font-bold bg-indigo-100 text-indigo-700 border border-indigo-200 uppercase">
                                        Super Admin
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-md text-[10px] font-bold bg-gray-100 text-gray-600 border border-gray-200 uppercase">
                                        Utilisateur
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                @if ($user->is_banned)
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700">
                                        <span class="w-1.5 h-1.5 mr-2 rounded-full bg-red-500"></span>
                                        Suspendu
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700">
                                        <span class="w-1.5 h-1.5 mr-2 rounded-full bg-emerald-500"></span>
                                        Actif
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end gap-2">
                                    @if ($user->id !== auth()->id())
                                        {{-- Sécurité : ne pas s'auto-bannir --}}
                                        <form action="" method="POST"
                                            onsubmit="return confirm('Confirmer l\'action sur cet utilisateur ?')">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="px-3 py-1.5 rounded-lg text-xs font-bold transition-all shadow-sm {{ $user->is_banned ? 'bg-emerald-600 text-white hover:bg-emerald-700' : 'bg-red-50 text-red-600 border border-red-100 hover:bg-red-600 hover:text-white' }}">
                                                {{ $user->is_banned ? 'Réactiver' : 'Bannir' }}
                                            </button>
                                        </form>
                                    @endif
                                    <button
                                        class="p-1.5 text-gray-400 hover:text-slate-900 transition hover:bg-gray-100 rounded-lg"
                                        title="Voir les détails">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
