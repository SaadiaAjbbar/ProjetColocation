@extends('layout')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Mes Colocations</h1>
    <p class="text-sm text-gray-500 mt-1">Gérez vos colocations actives et consultez votre historique.</p>
</div>

@if($colocations->isEmpty())
    <div class="bg-white border-2 border-dashed border-gray-200 rounded-2xl p-12 text-center">
        <div class="mx-auto w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
        </div>
        <h3 class="text-lg font-semibold text-gray-900">Aucune colocation</h3>
        <p class="text-gray-500 max-w-sm mx-auto mb-6">Vous ne faites partie d'aucune colocation pour le moment. Créez-en une ou attendez une invitation.</p>
        <a href="{{ route('colocations.create') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 transition shadow-sm">
            Créer ma première colocation
        </a>
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($colocations as $coloc)
            <div class="group bg-white rounded-2xl border border-gray-200 shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden flex flex-col">
                <div class="p-6">
                    <div class="flex items-start justify-between mb-4">

                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $coloc->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ ucfirst($coloc->status) }}
                        </span>
                    </div>

                    <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $coloc->name }}</h3>
                    <p class="text-sm text-gray-500 mb-4 flex items-center gap-1">
                        Tenu par <span class="font-medium text-gray-700 ml-1">{{ $coloc->owner->name }}</span>
                    </p>

                    <div class="flex items-center gap-4 text-sm text-gray-600">
                        <div class="flex items-center gap-1">
                            <span class="font-bold text-gray-900">{{ $coloc->adhesions_count ?? '0' }}</span> Membres
                        </div>
                        <div class="w-1 h-1 bg-gray-300 rounded-full"></div>
                        <div class="flex items-center gap-1">
                            <span class="font-bold text-gray-900">{{ $coloc->depenses_count ?? '0' }}</span> Dépenses
                        </div>
                    </div>
                </div>

                <div class="mt-auto border-t border-gray-100 bg-gray-50 p-4">
                    @if($coloc->adhesions->where('user_id', Auth::user()->id)->first()->role === 'owner')
                    <a href="{{ route('dashboardOwner', $coloc->id) }}" class="flex items-center justify-center w-full px-4 py-2 bg-white border border-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-blue-600 hover:text-white hover:border-blue-600 transition-all gap-2 shadow-sm">
                        Accéder au Dashboard
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                    @else
                    <a href="{{ route('dashboardMember', $coloc->id) }}" class="flex items-center justify-center w-full px-4 py-2 bg-white border border-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-blue-600 hover:text-white hover:border-blue-600 transition-all gap-2 shadow-sm">
                        Accéder au Dashboard
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection
