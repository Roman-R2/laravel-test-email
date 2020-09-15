<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Styles -->
        <link href="{{ mix('public/css/app.css', 'build') }}" rel="stylesheet">

    </head>
    <body style="height: 600px;">
            @yield('content')
    <!-- Scripts -->
    <script src="{{ mix('public/js/app.js', 'build') }}"></script>
    </body>
</html>
