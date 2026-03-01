@extends('layout')

@section('title', 'Nouvelle Dépense')

@section('content')
<div class="max-w-2xl mx-auto py-8">
    <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">

        <div class="bg-slate-900 p-8 text-white">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-indigo-500 rounded-2xl flex items-center justify-center text-2xl shadow-lg shadow-indigo-500/20">
                    💰
                </div>
                <div>
                    <h2 class="text-xl font-black uppercase tracking-tight italic">Enregistrer une facture</h2>
                    <p class="text-slate-400 text-[10px] font-black uppercase tracking-widest mt-1">Le montant sera divisé entre les participants</p>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('depenses.store', $colocation->id) }}" class="p-8 space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Nom de l'achat</label>
                    <input type="text" name="nom" placeholder="Ex: Courses Carrefour" required
                        class="w-full px-5 py-4 rounded-2xl border-2 border-slate-50 bg-slate-50 focus:bg-white focus:border-indigo-500 focus:ring-0 transition-all font-bold text-slate-700 outline-none">
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Date de la dépense</label>
                    <input type="date" name="date" required
                        class="w-full px-5 py-4 rounded-2xl border-2 border-slate-50 bg-slate-50 focus:bg-white focus:border-indigo-500 focus:ring-0 transition-all font-bold text-slate-700 outline-none">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Montant Total (DH)</label>
                    <input type="number" step="0.01" name="montant" placeholder="0.00" required
                        class="w-full px-5 py-4 rounded-2xl border-2 border-slate-50 bg-slate-50 focus:bg-white focus:border-indigo-500 focus:ring-0 transition-all font-black text-slate-900 text-xl outline-none">
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Catégorie</label>
                    <select name="categorie_id" required
                        class="w-full px-5 py-4 rounded-2xl border-2 border-slate-50 bg-slate-50 focus:bg-white focus:border-indigo-500 focus:ring-0 transition-all font-bold text-slate-700 outline-none appearance-none">

                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->nom }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <hr class="border-slate-50">

            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Qui a réglé la facture ?</label>
                <select name="payeur_id"
                    class="w-full px-5 py-4 rounded-2xl border-2 border-indigo-50 bg-indigo-50/30 focus:bg-white focus:border-indigo-500 focus:ring-0 transition-all font-bold text-indigo-900 outline-none appearance-none">
                    @foreach ($colocation->adhesions as $adhesion)
                        <option value="{{ $adhesion->user->id }}" {{ Auth::id() == $adhesion->user->id ? 'selected' : '' }}>
                            {{ $adhesion->user->name }} {{ Auth::id() == $adhesion->user->id ? '(Moi)' : '' }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="space-y-4">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Participants au partage</label>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @foreach ($colocation->adhesions as $adhesion)
                        <label class="flex items-center gap-3 p-4 rounded-2xl border-2 border-slate-50 bg-slate-50/50 cursor-pointer hover:border-indigo-200 transition group">
                            <input type="checkbox" name="participants[]" value="{{ $adhesion->user->id }}" checked
                                class="w-5 h-5 rounded-lg border-slate-300 text-indigo-600 focus:ring-indigo-500">
                            <span class="text-sm font-bold text-slate-700 group-hover:text-indigo-600">{{ $adhesion->user->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="pt-6">
                <button type="submit" class="w-full py-5 bg-indigo-600 text-white font-black rounded-2xl shadow-xl shadow-indigo-200 hover:bg-indigo-700 hover:-translate-y-1 transition-all uppercase text-xs tracking-widest">
                    Ajouter la dépense
                </button>
                <a href="{{ route('dashboardMember', $colocation->id) }}" class="block text-center mt-4 text-[10px] font-black text-slate-400 uppercase tracking-widest hover:text-rose-500 transition">
                    Annuler
                </a>
            </div>

        </form>
    </div>
</div>
@endsection
