<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>TERRASELL</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet"/>

    <style>
        [x-cloak] {
            display: none;
        }
        body {
            font-family: 'figtree', sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('{{ asset('images/farm.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;

        }

        .content {
            position: relative;
            z-index: 1;
        }

        .navbar .logo {
            display: flex;
            align-items: center;
        }
        .navbar .logo img {
            width: 60px;
            height: 60px;
            border: 2px solid #fff;
            border-radius: 50%;
            margin-right: 10px;
        }
        .navbar .logo .brand-name {
            color: #fff;
            font-size: 1.5rem;
            font-weight: bold;
        }
        .navbar .menu {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 20px;

        }
        .navbar .menu a {
            color: black;
            font-size: 1rem;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        .navbar .menu a:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @wireUiScripts

</head>

<body>
    <div class="overlay"></div>

    <header class="navbar">
        <div class="container mx-auto py-4">
            <div class="flex justify-between items-center">
                <div class="logo">
                    <img src="{{ asset('images/tersell.png') }}" alt="TERRASELL Logo">
                    <span class="brand-name">TERRASELL</span>
                </div>
                <nav class="menu">
                    <a href="{{ route('register') }}" class>Register</a>
                    <a href="{{ route('login') }}">Login</a>
                </nav>
            </div>
        </div>
    </header>

    <div class="content">
        <main class="container mx-auto py-8">
            {{ $slot }}
        </main>
    </div>

    @livewireScripts
</body>

</html>
