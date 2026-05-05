<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', "Lady's Home") }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            margin: 0;
            font-family: 'Figtree', sans-serif;
            background: linear-gradient(to right, #fdfbfb, #f7f1f2);
        }

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 30px;
        }

        .card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }

        header {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <div class="container">

        {{-- HEADER OPTIONNEL --}}
        @isset($header)
            <header>
                <div class="card">
                    {{ $header }}
                </div>
            </header>
        @endisset

        {{-- CONTENU --}}
        <main class="card">
            @yield('content')
        </main>

    </div>

</body>
</html>
