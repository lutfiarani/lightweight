<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('template/static/css/main.css') }}">
    <title>@yield('title')</title>
</head>
<body>
    @yield('content')

    <script src="{{ asset('template/assets/scripts/main.js') }}"></script>
</body>
</html>
