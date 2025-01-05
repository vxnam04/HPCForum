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

        <!-- Styles -->
        @yield('head1')
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        
    </head>
    <body class="font-sans antialiased">
            @livewire('navigation-menu')
            <header>
                <!-- Header chung -->
            </header> 
            <main>
                <!-- Nội dung chính của từng view -->
                @yield('content1')
                @yield('js')
                @yield('content2')
            </main>
        
            <footer>
                <!-- Footer chung -->
            </footer>
    </body>
</html>
