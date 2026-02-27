<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Navbar -->
    <nav class="bg-gray-900 text-white shadow-md mb-6">
        <div class="flex items-center gap-3">

    <a href="{{ route('admin.dashboard') }}"
       class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded text-sm font-medium transition">
        Accueil
    </a>

    <a href="{{ route('admin.my_colocations.index') }}"
       class="bg-green-600 hover:bg-green-700 px-4 py-2 rounded text-sm font-medium transition">
        Mes colocations
    </a>

    <a href="{{ route('admin.colocations.create') }}"
       class="bg-green-600 hover:bg-green-700 px-4 py-2 rounded text-sm font-medium transition">
        + Nouvelle Colocation
    </a>


    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit"
                class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded text-sm font-medium transition">
            Déconnexion
        </button>
    </form>
</div>
    </nav>

    <!-- Content -->
    <div class="max-w-7xl mx-auto px-6">
        @yield('content')
    </div>

</body>
</html>
