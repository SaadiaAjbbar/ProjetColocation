@extends('admin.layout')
@section('content')

<h1 class="text-2xl font-bold mb-6">
    Catégories - {{ $colocation->name }}
</h1>

@if(session('success'))
<div class="bg-green-100 text-green-700 p-3 rounded mb-4">
    {{ session('success') }}
</div>
@endif

<a href="{{ route('admin.categories.create', $colocation->id) }}"
   class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">
    Ajouter Catégorie
</a>

<div class="bg-white shadow rounded-lg p-6">
    <ul>
        @forelse($categories as $category)
            <li class="border-b py-2">
                {{ $category->nom }}
            </li>
        @empty
            <li class="text-gray-500">Aucune catégorie</li>
        @endforelse
    </ul>
</div>

@endsection
