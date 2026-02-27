@extends('admin.layout')

@section('content')
    <div class="max-w-xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('admin.my_colocations.index') }}"
                class="text-sm text-blue-600 hover:text-blue-800 flex items-center gap-2 group transition">
                <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Retour à mes colocations
            </a>
        </div>

        <div class="mb-8">
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Nouvelle Colocation</h1>

        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 h-2"></div>

            <form action="{{ route('admin.colocations.store') }}" method="POST" class="p-8">
                @csrf

                <div class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">
                            Nom de la colocation
                        </label>
                        <div class="relative">

                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                placeholder="Ex: La Villa des Amis, Appart 402..."
                                class="block w-full pl-12 pr-4 py-4 bg-gray-50 border {{ $errors->has('name') ? 'border-red-500' : 'border-gray-200' }} rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all text-gray-900 font-medium"
                                required>
                        </div>

                        @error('name')
                            <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>



                    <button type="submit"
                        class="w-full bg-slate-900 hover:bg-black text-white font-bold py-4 rounded-xl shadow-lg transform active:scale-95 transition-all duration-200 flex items-center justify-center gap-2">
                        Lancer la colocation
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
