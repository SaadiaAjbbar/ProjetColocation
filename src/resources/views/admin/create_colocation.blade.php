@extends('admin.layout')

@section('content')

<h1 class="text-2xl font-bold mb-6">
    Créer Nouvelle Colocation
</h1>

@if ($errors->any())
<div class="bg-red-100 text-red-700 p-4 mb-4 rounded">
    @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
    @endforeach
</div>
@endif

<form action="{{ route('admin.colocations.store') }}"
      method="POST"
      class="bg-white shadow p-6 rounded max-w-md">

    @csrf

    <div class="mb-4">
        <label class="block mb-2 text-gray-700">
            Nom de la colocation
        </label>

        <input type="text"
               name="name"
               class="w-full border rounded px-3 py-2 focus:ring focus:ring-green-200"
               required>
    </div>

    <button type="submit"
            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
        Créer
    </button>
</form>

@endsection
