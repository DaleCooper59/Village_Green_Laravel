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
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <x-buttonConnexion path="{{ url('/dashboard')  }}" action='Dashboard' />
                    @else
                        <x-buttonConnexion path="{{ route('login') }}" action='Se connecter' />

                        @if (Route::has('register'))
                            <x-buttonConnexion path="{{ route('register') }}" action='Créer un compte' />

                        @endif
                    @endauth
                </div>
            @endif

            

                   
                </div>
            </div>
        </div>
    </body>
</html>

