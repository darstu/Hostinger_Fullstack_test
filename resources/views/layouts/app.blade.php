<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Junior Developer Task Hostinger</title>

    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('css/page.css') }}" type="text/css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user-id" content="{{ Auth::user()->id }}">
</head>

<body>
    <div id="app">
        <div class="col-12 meniuPurple">
            <nav class="navbar-expand-lg mb-5">

                <p class="meniuName">Hotinger Gift Campaigns System</p>

                <div class="mainMeniuBTN">
                    <a class="seemlessLink" href="{{ route('mainPage') }}">Home</a>
                </div>
                <div class="mainMeniuBTN">
                    <a class="seemlessLink" href="{{ route('signout') }}">Logout</a>
                </div>

            </nav>
        </div>

        @yield('content')

    </div>

    <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>
