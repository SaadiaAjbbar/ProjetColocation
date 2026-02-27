@extends('admin.layout')

@section('content')

<h1 class="text-2xl font-bold mb-6">
    Dashboard - {{ $colocation->name }}
</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <a href="#" class="bg-white shadow p-6 rounded-lg hover:bg-gray-50">
        Ajouter dépense
    </a>

    <a href="#" class="bg-white shadow p-6 rounded-lg hover:bg-gray-50">
        Marquer paiement
    </a>

    <a href="#" class="bg-white shadow p-6 rounded-lg hover:bg-gray-50">
        Voir membres
    </a>

</div>

@endsection
