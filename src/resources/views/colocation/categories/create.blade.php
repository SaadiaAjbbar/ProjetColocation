@extends('layout')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('my_colocations.index') }}" class="text-sm text-blue-600 hover:text-blue-800 flex items-center gap-2 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Retour aux colocations
        </a>
    </div>

    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Nouvelle Catégorie</h1>
        <p class="text-sm text-gray-500 mt-1">
            Ajout d'une catégorie de dépense pour la colocation :
            <span class="font-semibold text-gray-700">{{ $colocation->name }}</span>
        </p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <form method="POST" action="{{ route('categories.store', $colocation->id) }}" class="p-8">
            @csrf

            <div class="space-y-6">
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                        Nom de la catégorie
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        </div>
                        <input type="text"
                               id="name"
                               name="name"
                               value="{{ old('name') }}"
                               placeholder="Ex: Alimentation, Loyer, Électricité..."
                               class="block w-full pl-10 pr-3 py-3 border {{ $errors->has('name') ? 'border-red-300' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition sm:text-sm"
                               required>
                    </div>
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>


                <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                    <button type="reset" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                        Réinitialiser
                    </button>
                    <button type="submit" class="px-6 py-2 text-sm font-semibold text-white bg-emerald-600 rounded-lg hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 shadow-sm transition">
                        Enregistrer la catégorie
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
