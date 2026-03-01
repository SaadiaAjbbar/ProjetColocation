@extends('layout')

@section('content')
        <div class="max-w-5xl mx-auto py-12">
            <div class="text-center mb-16">
                <div
                    class="inline-flex items-center justify-center w-20 h-20 bg-blue-100 text-blue-600 rounded-3xl mb-6 shadow-sm">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                </div>
                <h1 class="text-4xl font-black text-gray-900 tracking-tight mb-4">
                    Bienvenu dans <span class="text-blue-600">ColocationSystem</span> !
                </h1>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                    la meilleure methode pour gerer les depenses de votre colocations avec vos collegues sans problemes , nous sommes ici pour faciliter vos calcules
                    
                </p>
            </div>



            <div class="bg-slate-900 rounded-[2.5rem] p-12 text-center relative overflow-hidden shadow-2xl">
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-blue-500 opacity-20 rounded-full"></div>
                <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-indigo-500 opacity-20 rounded-full"></div>

                <div class="relative z-10">
                    <h2 class="text-3xl font-bold text-white mb-6">pret a commencer?</h2>
                    <p class="text-slate-400 mb-10 max-w-md mx-auto italic">
                        Cliquer sur le button pour creer une colocation est devien le owner de cette colocation!
                    </p>
                    <a href="{{ route('colocations.create') }}"
                        class="inline-flex items-center px-10 py-5 bg-blue-600 hover:bg-blue-700 text-white font-black text-lg rounded-2xl transition-all transform hover:scale-105 active:scale-95 shadow-xl shadow-blue-900/40 gap-3">
                        <span>Ma Colocation</span>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
@endsection
