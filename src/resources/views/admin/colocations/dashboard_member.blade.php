@extends('admin.layout')

@section('content')
    <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <nav class="flex mb-2 text-sm text-gray-500" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2">
                    <li><a href="{{ route('admin.my_colocations.index') }}" class="hover:text-blue-600">Mes Colocations</a>
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
        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
            <p class="text-sm font-medium text-gray-500">Dépenses totales</p>
            <p class="text-2xl font-bold text-gray-900 mt-1">1 240,50 €</p>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
            <p class="text-sm font-medium text-gray-500">Ma part</p>
            <p class="text-2xl font-bold text-blue-600 mt-1">310,12 €</p>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
            <p class="text-sm font-medium text-gray-500">Membres</p>
            <p class="text-2xl font-bold text-gray-900 mt-1">{{ $colocation->members_count ?? '4' }}</p>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
            <p class="text-sm font-medium text-gray-500">Réputation Moyenne</p>
            <div class="flex items-center gap-1 mt-1 text-amber-500 font-bold">
                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                    <path
                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
                <span>4.8</span>
            </div>
        </div>
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

        <div class="space-y-4">
            <div class="flex items-center justify-between py-3 border-b border-slate-800">
                <div class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 rounded-full bg-orange-500 flex items-center justify-center text-sm font-bold ring-2 ring-slate-800">
                        JD</div>
                    <div>
                        <p class="font-medium">Jean Dupont</p>
                        <p class="text-[10px] text-slate-500 uppercase">Payé 450€ au total</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="text-red-400 font-mono font-bold">- 45,00 €</span>
                    <p class="text-[10px] text-slate-500">Doit payer</p>
                </div>
            </div>

            <div class="flex items-center justify-between py-3">
                <div class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-sm font-bold ring-2 ring-slate-800">
                        MA</div>
                    <div>
                        <p class="font-medium">Marie Alix</p>
                        <p class="text-[10px] text-slate-500 uppercase">Payé 890€ au total</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="text-emerald-400 font-mono font-bold">+ 120,50 €</span>
                    <p class="text-[10px] text-slate-500">À recevoir</p>
                </div>
            </div>
        </div>
    </div>
@endsection
