<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Dashboard Admin</a>
            <div class="d-flex">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-primary me-2">Accueil</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-danger">Déconnexion</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>
</body>
</html>
