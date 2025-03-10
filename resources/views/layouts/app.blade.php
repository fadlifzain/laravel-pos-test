<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    @auth
        <div class="max-w-screen-xl mx-auto p-6">
            <!-- Header -->
            <header class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800">POS System</h1>
                
                <!-- Navigation Menu -->
                <nav class="flex space-x-4">
                    <a href="{{ url('/pos') }}" class="bg-green-600  text-white py-2 px-4 rounded-lg hover:bg-green-700">POS</a>
                    <a href="{{ route('products.manage') }}" class="bg-gray-600 text-white py-2 px-4 rounded-lg hover:bg-gray-700">Manage Products</a>
                    <a href="{{ route('orders.index') }}" class="bg-cyan-600 text-white py-2 px-4 rounded-lg hover:bg-cyan-700">Orders</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700">
                            Log Out
                        </button>
                    </form>
                </nav>
            </header>

            <!-- Main Content -->
            <main>
                @yield('content')
            </main>
        </div>
    @else
        <script>window.location.href = "{{ route('login') }}";</script>
    @endauth

</body>
</html>
