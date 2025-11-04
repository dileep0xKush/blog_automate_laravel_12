<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Tailwind CSS (via CDN for simplicity) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex flex-col min-h-screen">

    <!-- Header -->
    <header class="bg-blue-600 text-white p-4">
        <h1 class="text-xl font-semibold">{{ config('app.name', 'Laravel App') }}</h1>
    </header>

    <div class="flex flex-1">
        <!-- Sidebar -->
        <aside class="bg-gray-800 text-white w-64 p-4 hidden md:block">
            <nav class="space-y-2">
                <a href="/" class="block py-2 px-3 rounded hover:bg-gray-700">Dashboard</a>
                <a href="/news" class="block py-2 px-3 rounded hover:bg-gray-700">news</a>
                <a href="#" class="block py-2 px-3 rounded hover:bg-gray-700">Settings</a>
                <a href="#" class="block py-2 px-3 rounded hover:bg-gray-700">Logout</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-blue-600 text-white text-center p-4">
        &copy; {{ date('Y') }} {{ config('app.name', 'Laravel App') }}. All rights reserved.
    </footer>

</body>

</html>
