@extends('layout')

@section('content')
    <div class="max-w-xl mx-auto">

        <h1 class="text-2xl font-bold mb-6">
            Modifier Catégorie - {{ $colocation->name }}
        </h1>

        <form method="POST" action="{{ route('categories.update', [$colocation->id, $category->id]) }}"
            class="bg-white shadow p-6 rounded-lg">

            @csrf
            @method('PUT')

            <input type="text" name="name" value="{{ $category->nom }}" class="border p-2 rounded w-full mb-4" required>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                Modifier
            </button>

        </form>

    </div>
@endsection
