<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Junior Developer Task Hostinger</title>

    <!-- Fonts -->
    {{-- <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="antialiased">
    <div id="app">
        @guest
        @if (Route::has('loginPage'))
        @auth
        <a href="{{ url('/home') }}">Home</a>
        @else
        <a href="{{ route('loginPage') }}">Log in</a>
        @endauth
        @endif
        @if (Route::has('registerPage'))
        <a href="{{ route('registerPage') }}">Register</a>
        @endif
        @endguest

        @yield('content')
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>
