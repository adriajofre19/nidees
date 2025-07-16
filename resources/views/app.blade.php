<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        
        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body>
        @inertia
    </body>
    <style>
        @font-face {
          font-family: 'Comfortaa';
          src: url('/fonts/comforta-regular.woff2') format('woff2');
          font-weight: 400;
        }

        @font-face {
          font-family: 'Comfortaa';
          src: url('/fonts/comforta-regular.woff2') format('woff2');
          font-weight: 600;
          font-display: swap;
        }

        @font-face {
          font-family: 'Comfortaa';
          src: url('/fonts/comforta-regular.woff2') format('woff2');
          font-weight: 700;
        }
        body {
          font-family: 'Comfortaa', sans-serif;
        }
    </style>
</html>
