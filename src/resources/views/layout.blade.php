<!DOCTYPE html>
<html lang="fr" class="h-full bg-gray-50">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Colocation Systeme| Admin </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="h-full overflow-hidden flex">

    <aside class="w-64 bg-slate-900 text-white flex flex-col hidden md:flex">
        <div class="p-6">
            <h1 class="text-2xl font-bold tracking-tight text-blue-400">Colocation<span class="text-white">Systeme</span></h1>
            <p class="text-xs text-slate-400 uppercase tracking-widest mt-1">Global Admin</p>
        </div>
        <nav class="flex-1 px-4 space-y-2">
            <p class="text-[10px] font-semibold text-slate-500 uppercase px-2">Navigation</p>

            <a href="{{ route('dashboardAdmin') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-lg transition {{ request()->routeIs('dashboardAdmin') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-slate-800' }}">

                Statistiques
            </a>

            <a href="{{ route('my_colocations.index') }}"
                class="flex items-center gap-3 px-3 py-2 rounded-lg transition hover:bg-slate-800 text-slate-300">

                Mes Colocations
            </a>

            <div class="pt-4 mt-4 border-t border-slate-800">
                <p class="text-[10px] font-semibold text-slate-500 uppercase px-2 mb-2">Actions</p>
                <a href="{{ route('colocations.create') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg bg-emerald-600/10 text-emerald-400 hover:bg-emerald-600/20 transition border border-emerald-600/20">
                    <span class="text-lg font-bold">+</span>
                    Nouvelle Colocation
                </a>
            </div>
        </nav>

        <div class="p-4 border-t border-slate-800 bg-slate-950/50">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center font-bold text-xs">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="overflow-hidden text-ellipsis">
                    <p class="text-sm font-medium truncate">{{ Auth::user()->name }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full text-left text-xs text-red-400 hover:text-red-300 transition flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                        </path>
                    </svg>
                    Déconnexion
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 flex flex-col min-w-0 overflow-hidden">
        <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-8 shrink-0">
            <h2 class="text-lg font-semibold text-gray-800 uppercase tracking-tight">Dashboard</h2>
            <div class="flex items-center gap-4">
                <span
                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                    Mode Admin
                </span>
            </div>
        </header>

        <section class="flex-1 overflow-y-auto p-8 bg-gray-50">
            <div class="max-w-6xl mx-auto">
                @yield('content')
            </div>
        </section>
        @if (session('success'))
            <div  id="prompte" class="absolute bottom-4 right-4 bg-emerald-500 text-white px-4 py-2 rounded-lg shadow-lg">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div id="prompte" class="absolute bottom-4 right-4 bg-red-500 text-white px-4 py-2 rounded-lg shadow-lg">
                {{ session('error') }}
            </div>
        @endif
    </main>

    <script>
        // Masquer le prompte après 3 secondes
        setTimeout(() => {
            const prompte = document.getElementById('prompte');
            if (prompte) {
                prompte.style.display = 'none';
            }
        }, 3000);
    </script>
</body>

</html>
