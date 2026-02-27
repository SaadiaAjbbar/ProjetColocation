@extends('admin.layout')

@section('content')
    <h1 class="text-2xl font-bold mb-6">
        Ajouter Catégorie - {{ $colocation->name }}
    </h1>

    <form method="POST" action="{{ route('admin.categories.store', $colocation->id) }}"
        class="bg-white shadow p-6 rounded-lg max-w-md">

        @csrf

        <input type="text" name="name" placeholder="Nom de la catégorie" class="border p-2 rounded w-full mb-4" required>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">
            Enregistrer
        </button>

    </form>
@endsection
