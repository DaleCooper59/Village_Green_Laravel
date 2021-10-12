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
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" />

    @livewireStyles

    @yield('css')

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    @yield('js')

</head>

<body class="antialiased">
    <div id="content_page" class="w-full lg:w-3/4 mx-auto">

        <x-navbar-sup-index />
        <x-navbar-index />
        

        @yield('navbar')

        @include('layouts/flashMessage')


        @yield('content')

    </div>
    @include('layouts/footer')
    
    @yield('js_footer')
    @livewireScripts
</body>

</html>
