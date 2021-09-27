<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" type="text/css" >

    @yield('css')

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    @yield('js')

</head>

<body class="antialiased">
    <div class="w-full lg:w-3/4 mx-auto">
        @yield('navbar')

        <main class="container mx-auto px-12 md:px-20 h-min-full mt-36 md:mt-44">

            @include('layouts/ad_banner')

            @include('layouts/garantie_banner')

            @yield('content')

        </main>

        @yield('js_footer')

        @include('layouts/footer')
    </div>
   
</body>

</html>
