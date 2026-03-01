@extends('layout')

@section('content')
    <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <nav class="flex mb-2 text-sm text-gray-500" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2">
                    <li><a href="{{ route('my_colocations.index') }}" class="hover:text-blue-600">Mes Colocations</a>
                    </li>
                    <li><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 11H3a1 1 0 110-2h7.586l-3.293-3.293a1 1 0 011.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z">
                            </path>
                        </svg></li>
                    <li class="text-gray-900 font-medium">{{ $colocation->name }}</li>
                </ol>
            </nav>
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Tableau de Bord</h1>
        </div>

        <div class="flex gap-3">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                <span class="w-2 h-2 mr-2 rounded-full bg-blue-500 animate-pulse"></span>
                Session Active
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <!--******** totalDepenses *********-->
        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
            <p class="text-sm font-medium text-gray-500">total Depenses</p>
            <p class="text-2xl font-bold text-gray-900 mt-1">
                {{ number_format($totalDepenses, 2) }} €
            </p>
        </div>
        <!--******** montant_du *********-->
        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
            <p class="text-sm font-medium text-gray-500">ma part</p>
            <p class="text-2xl font-bold text-blue-600 mt-1">
                {{ number_format($maPart, 2) }} €
            </p>
        </div>
        <a href="{{ route('colocations.members', $colocation->id) }}"
            class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm hover:border-blue-500 hover:shadow-md transition block">
            <p class="text-sm font-medium text-gray-500">Membres</p>
            <p class="text-2xl font-bold text-gray-900 mt-1">
                {{ $membersCount }}
            </p>
        </a>
    </div>

    <h2 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-4">Actions Rapides</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

        <a href=""
            class="group relative bg-white p-8 rounded-2xl border border-gray-200 shadow-sm hover:border-blue-500 hover:shadow-md transition-all">
            <div
                class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mb-4 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                    </path>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-gray-900">Ajouter dépense</h3>
            <p class="text-sm text-gray-500 mt-1">Enregistrez un nouvel achat commun.</p>
        </a>

        <a href="#"
            class="group relative bg-white p-8 rounded-2xl border border-gray-200 shadow-sm hover:border-emerald-500 hover:shadow-md transition-all">
            <div
                class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center mb-4 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
                    </path>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-gray-900">Marquer paiement</h3>
            <p class="text-sm text-gray-500 mt-1">Régularisez vos dettes envers les membres.</p>
        </a>

        <a href="#"
            class="group relative bg-white p-8 rounded-2xl border border-gray-200 shadow-sm hover:border-indigo-500 hover:shadow-md transition-all">
            <div
                class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center mb-4 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                    </path>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-gray-900">Gérer les membres</h3>
            <p class="text-sm text-gray-500 mt-1">Invitez ou retirez des colocataires.</p>
        </a>

    </div>

    <div class="bg-slate-900 rounded-2xl p-8 text-white shadow-xl">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="text-xl font-bold uppercase tracking-tight">Aperçu des Balances</h3>
                <p class="text-xs text-slate-400 mt-1 font-mono italic">Calculé selon la règle d'équité</p>
            </div>
            <button
                class="text-sm text-slate-400 hover:text-white border border-slate-700 px-3 py-1 rounded-lg transition">Voir
                le détail →</button>
        </div>

        @if ($balance > 0)
            <span class="text-emerald-400 font-mono font-bold">
                + {{ number_format($balance, 2) }} €
            </span>
            <p class="text-[10px] text-slate-500">À recevoir</p>
        @elseif($balance < 0)
            <span class="text-red-400 font-mono font-bold">
                - {{ number_format(abs($balance), 2) }} €
            </span>
            <p class="text-[10px] text-slate-500">Doit payer</p>
        @else
            <span class="text-gray-400 font-mono font-bold">
                0.00 €
            </span>
            <p class="text-[10px] text-slate-500">Équilibré</p>
        @endif
    </div>

    <form action="{{ route('colocations.leave', $colocation->id) }}" method="POST"
        onsubmit="return confirm('Êtes-vous sûr de vouloir quitter cette colocation ?');">
        @csrf
        @method('DELETE')

        <button type="submit"
            class="mt-6 bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-xl text-sm font-semibold shadow">
            Quitter la colocation
        </button>
    </form>
@endsection
