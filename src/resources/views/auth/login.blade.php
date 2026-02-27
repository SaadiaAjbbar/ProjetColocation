<!DOCTYPE html>
<html lang="fr" class="h-full bg-gray-50">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion | ColocationSysteme</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="h-full flex items-center justify-center p-6">

    <div class="max-w-md w-full">
        <div class="text-center mb-10">
            <h1 class="text-4xl font-black text-slate-900 tracking-tight">
                Colocation<span class="text-blue-600">Systeme</span>
            </h1>
            <p class="text-gray-500 mt-2 font-medium">Gérez vos dépenses sans stress.</p>
        </div>

        <div class="bg-white p-8 rounded-3xl shadow-xl shadow-blue-900/5 border border-gray-100">
            <h2 class="text-xl font-bold text-gray-800 mb-6">Bon retour !</h2>

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-lg">
                    <p class="text-sm text-red-700 font-medium">Identifiants incorrects.</p>
                </div>
            @endif

            <form action="{{ url('/login') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Adresse Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none"
                        placeholder="nom@exemple.com" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Mot de passe</label>
                    <input type="password" name="password"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none"
                        placeholder="••••••••" required>
                </div>

                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center gap-2 text-gray-600 cursor-pointer">
                        <input type="checkbox" name="remember"
                            class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        Se souvenir de moi
                    </label>
                    <a href="#" class="text-blue-600 font-semibold hover:underline">Oublié ?</a>
                </div>

                <button type="submit"
                    class="w-full bg-slate-900 hover:bg-black text-white font-bold py-4 rounded-xl shadow-lg shadow-slate-200 transition-all active:scale-[0.98]">
                    Se connecter
                </button>
            </form>
        </div>

        <p class="text-center text-gray-500 mt-8 text-sm">
            Pas encore de compte ?
            <a href="{{ url('/register') }}" class="text-blue-600 font-bold hover:underline">Créer compte</a>
        </p>
    </div>

</body>

</html>
