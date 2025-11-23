<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
    <body class="flex flex-col w-screen h-screen max-w-[100vw] min-h-screen overflow-x-hidden">
        @include('layouts.header')

        <main class="grow w-screen min-h-[50vh] max-w-[100vw] @yield('main-overflow', 'overflow-y-hidden')">
            @yield('content')
        </main>

        @include('layouts.footer')

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
