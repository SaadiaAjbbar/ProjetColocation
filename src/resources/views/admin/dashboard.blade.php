@extends('admin.layout')

@section('content')
<h1>Statistiques Globales</h1>
<div class="row mb-4">
    <div class="col-md-3"><div class="card p-3 bg-light">Utilisateurs: {{ $stats['total_users'] }}</div></div>
    <div class="col-md-3"><div class="card p-3 bg-light">Colocations: {{ $stats['total_colocations'] }}</div></div>
    <div class="col-md-3"><div class="card p-3 bg-light">Dépenses: {{ $stats['total_depenses'] }}</div></div>
    <div class="col-md-3"><div class="card p-3 bg-light">Utilisateurs bannis: {{ $stats['banned_users'] }}</div></div>
</div>

<h2>Liste des Colocations</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nom Colocation</th>
            <th>Owner</th>
            <th>Membres</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($colocations as $coloc)
        <tr>
            <td>{{ $coloc->name }}</td>
            <td>{{ $coloc->owner->name }}</td>
            <td>{{ $coloc->adhesions->count() }}</td>
            <td>{{ $coloc->status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
