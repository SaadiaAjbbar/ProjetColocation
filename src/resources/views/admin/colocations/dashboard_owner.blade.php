@extends('admin.layout')

@section('content')
    <h1 class="text-2xl font-bold mb-6">
        Dashboard Owner - {{ $colocation->name }}
    </h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <a href="{{ route('admin.categories.index', $colocation->id) }}"
            class="bg-white shadow p-6 rounded-lg hover:bg-gray-50 block">
            Gérer catégories
        </a>

        <a href="#" class="bg-white shadow p-6 rounded-lg hover:bg-gray-50">
            Inviter membres
        </a>

        <a href="#" class="bg-white shadow p-6 rounded-lg hover:bg-gray-50">
            Ajouter dépense
        </a>

    </div>
@endsection
