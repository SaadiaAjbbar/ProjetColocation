@extends('layout')

@section('content')
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-2">
            <span
                class="px-3 py-1 bg-amber-100 text-amber-700 text-xs font-bold uppercase rounded-full border border-amber-200">
                Mode Administrateur de Colocation
            </span>
        </div>
        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight italic">
            {{ $colocation->name }}
        </h1>
        <p class="text-gray-500 mt-1">Gérez vos membres et validez les remboursements.</p>
    </div>

    <h2 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4 flex items-center gap-2">
        👥 État des comptes & Actions
    </h2>
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden mb-10">
        <div class="divide-y divide-gray-100">
            @foreach ($usersTotals as $userTotal)
                <div class="p-5 flex items-center justify-between hover:bg-gray-50 transition">
                    <div class="flex items-center gap-4">
                        <div
                            class="w-10 h-10 {{ $userTotal['user']->id == Auth::id() ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-400' }} rounded-xl flex items-center justify-center font-bold uppercase text-xs">
                            {{ strtoupper(substr($userTotal['user']->name, 0, 2)) }}
                        </div>
                        <div>
                            <span class="font-bold text-gray-900 italic block leading-none">
                                {{ $userTotal['user']->name }}
                                @if ($userTotal['user']->id == Auth::id())
                                    (Moi)
                                @endif
                            </span>
                            @if ($userTotal['montant_du'] < 0)
                                <span class="text-[10px] font-black text-red-400 uppercase tracking-tighter italic">Doit
                                    payer</span>
                            @elseif ($userTotal['montant_du'] > 0)
                                <span class="text-[10px] font-black text-emerald-400 uppercase tracking-tighter italic">Doit
                                    recevoir</span>
                            @endif
                        </div>
                    </div>

                    <div class="flex items-center gap-6">
                        <div class="text-right">
                            @if ($userTotal['montant_du'] < 0)
                                <span class="text-lg font-black text-red-500">-
                                    {{ number_format(abs($userTotal['montant_du']), 2) }} DH</span>
                            @elseif ($userTotal['montant_du'] > 0)
                                <span class="text-lg font-black text-emerald-500">+
                                    {{ number_format($userTotal['montant_du'], 2) }} DH</span>
                            @else
                                <span class="text-lg font-black text-gray-300">0.00 DH</span>
                            @endif
                        </div>

                        @if ($userTotal['montant_du'] > 0 && $userTotal['user']->id != Auth::id())
                            <form action="{{ route('paiements.valider', [$colocation->id, $userTotal['user']->id]) }}"
                                method="POST">
                                @csrf
                                <button type="submit"
                                    class="flex items-center gap-2 px-4 py-2 bg-emerald-500 text-white text-[10px] font-black uppercase rounded-lg hover:bg-emerald-600 shadow-md shadow-emerald-100 transition-all active:scale-95">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Valider
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
        <a href="{{ route('categories.index', $colocation->id) }}"
            class="bg-white p-6 rounded-2xl border border-gray-200 flex items-center gap-4">
            <span class="text-2xl">🏷️</span>
            <span class="font-bold">Gérer catégories</span>
        </a>
        <div class="bg-white p-6 rounded-2xl border border-gray-200">
            <h3 class="font-bold mb-2">Inviter membre</h3>
            <form action="{{ route('invitations.store', $colocation->id) }}" method="POST" class="flex gap-2">
                @csrf
                <input type="email" name="email" class="border rounded-lg px-3 py-1 flex-1 text-sm" placeholder="Email"
                    required>
                <button class="bg-indigo-600 text-white px-3 py-1 rounded-lg text-xs uppercase font-bold">OK</button>
            </form>
        </div>
    </div>

    <a href="{{ route('depenses.create', $colocation->id) }}"
        class="w-full bg-white p-8 rounded-2xl border-2 border-dashed border-gray-200 flex flex-col items-center hover:border-emerald-500 transition">
        <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mb-2">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
        </div>
        <span class="font-bold text-gray-900">Ajouter une dépense</span>
    </a>

    <div class="mt-10 p-6 bg-red-50 rounded-2xl flex justify-between items-center border border-red-100">
        <span class="text-xs font-bold text-red-700 uppercase italic">Zone de danger</span>
        <form action="{{ route('colocations.cancel', $colocation->id) }}" method="POST">
            @csrf
            <button
                class="text-[10px] font-black text-red-600 bg-white border border-red-200 px-4 py-2 rounded-lg uppercase">Annuler
                Coloc</button>
        </form>
    </div>
@endsection
