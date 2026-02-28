@extends('admin.layout')

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
        <p class="text-gray-500 mt-1">Gérez vos membres, vos catégories et suivez la comptabilité du foyer.</p>
    </div>

    <h2 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4 flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
            </path>
        </svg>
        Administration
    </h2>
    <!--****************Gerer categories*************-->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
        <a href="{{ route('admin.categories.index', $colocation->id) }}"
            class="group bg-white p-6 rounded-2xl border border-gray-200 shadow-sm hover:border-blue-500 hover:shadow-md transition-all flex items-center gap-5">

            <div>
                <h3 class="text-lg font-bold text-gray-900">Gérer catégories</h3>
                <p class="text-sm text-gray-500">Personnalisez les types de dépenses.</p>
            </div>
        </a>
        <!--***************Inviter member************-->
        <form action="{{ route('admin.invitations.store', $colocation->id) }}" method="POST"
            class="group bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
            @csrf
            <h3 class="text-lg font-bold mb-2">Inviter membre</h3>
            <input type="email" name="email" placeholder="Email du membre" class="border rounded px-3 py-2 w-full mb-3"
                required>
            <button class="bg-indigo-600 text-white px-4 py-2 rounded">
                Envoyer invitation
            </button>
        </form>
    </div>

    <h2 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Finances & Vie Commune</h2>
    <div class="grid grid-cols-1 md:grid-cols-1 gap-6 mb-10">
        <a href="#"
            class="group bg-white p-8 rounded-2xl border-2 border-dashed border-gray-200 hover:border-emerald-500 hover:bg-emerald-50/30 transition-all flex flex-col items-center justify-center text-center">
            <div class="w-16 h-16 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mb-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                    </path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900">Ajouter une dépense</h3>
            <p class="text-gray-500 mt-1 max-w-xs">Partagez un nouveau coût avec l'ensemble des membres de la colocation.
            </p>
        </a>
    </div>

    <div class="mt-12 p-6 border border-red-100 bg-red-50/50 rounded-2xl flex items-center justify-between">
        <div>
            <h4 class="text-sm font-bold text-red-800 uppercase">Zone de danger</h4>
            <p class="text-xs text-red-600">L'annulation de la colocation est irréversible et affectera la réputation des
                membres débiteurs.</p>
        </div>
        <!--********************** Annuler Colocation *******************-->
        <form action="{{ route('admin.colocations.cancel', $colocation->id) }}" method="POST"
            onsubmit="return confirm('Êtes-vous sûr de vouloir annuler cette colocation ?')">
            @csrf
            <button
                class="px-4 py-2 bg-white border border-red-200 text-red-600 text-xs font-bold rounded-lg hover:bg-red-600 hover:text-white transition-all shadow-sm uppercase tracking-tighter">
                Annuler la colocation
            </button>
        </form>
    </div>
@endsection
