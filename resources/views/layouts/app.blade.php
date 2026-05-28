<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Perpustakaan Sekolah') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-100 text-slate-800">
    <div class="min-h-screen">
        <header class="bg-slate-900 text-white shadow-sm">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
                <a href="{{ route('dashboard') }}" class="text-lg font-semibold tracking-wide">Perpus Sekolah</a>
                @auth
                    <nav class="flex items-center gap-4 text-sm">
                        <a href="{{ route('dashboard') }}" class="hover:text-cyan-300">Dashboard</a>
                        <a href="{{ route('books.index') }}" class="hover:text-cyan-300">Daftar Buku</a>
                        <a href="{{ route('loans.index') }}" class="hover:text-cyan-300">Peminjaman</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="rounded bg-cyan-500 px-4 py-2 text-sm font-semibold text-white hover:bg-cyan-400">Logout</button>
                        </form>
                    </nav>
                @endauth
            </div>
        </header>

        <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 rounded-xl border border-green-200 bg-green-50 p-4 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-red-800">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 rounded-xl border border-rose-200 bg-rose-50 p-4 text-rose-800">
                    <ul class="list-disc space-y-1 pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
