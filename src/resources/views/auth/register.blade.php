<!DOCTYPE html>
<html lang="fr" class="h-full bg-gray-50">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un compte | ColocationSysteme</title>
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
            <p class="text-gray-500 mt-2 font-medium">Rejoignez l'aventure et simplifiez vos comptes.</p>
        </div>

        <div class="bg-white p-8 rounded-3xl shadow-xl shadow-blue-900/5 border border-gray-100">
            <h2 class="text-xl font-bold text-gray-800 mb-6">Créer un compte</h2>

            <form action="{{ url('/register') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nom complet</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="w-full px-4 py-3 rounded-xl border {{ $errors->has('name') ? 'border-red-500' : 'border-gray-200' }} focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none"
                        placeholder="Ex: Jean Dupont" required>
                    @error('name')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Adresse Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full px-4 py-3 rounded-xl border {{ $errors->has('email') ? 'border-red-500' : 'border-gray-200' }} focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none"
                        placeholder="nom@exemple.com" required>
                    @error('email')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Mot de passe</label>
                    <input type="password" name="password"
                        class="w-full px-4 py-3 rounded-xl border {{ $errors->has('password') ? 'border-red-500' : 'border-gray-200' }} focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all outline-none"
                        placeholder="Min. 8 caractères" required>
                    @error('password')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>


                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-xl shadow-lg shadow-blue-200 transition-all active:scale-[0.98]">
                    S'inscrire
                </button>
            </form>
        </div>

        <p class="text-center text-gray-500 mt-8 text-sm">
            Déjà un compte ?
            <a href="{{ url('/login') }}" class="text-blue-600 font-bold hover:underline">Se connecter</a>
        </p>
    </div>

</body>

</html>
