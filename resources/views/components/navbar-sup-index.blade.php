<div class="flex justify-end">
<ul class="absolute z-10 top-0 flex items-center justify-end w-full lg:w-3/4 mx-auto h-10 bg-gradient-to-r from-gray-100 via-white to-white sm:items-center sm:pt-0">
    <!---------------------Connexion-------------->
    @if (Route::has('login'))
       
        @auth
            <li>
                <x-buttonConnexion path="{{ url('/dashboard') }}" action='Dashboard'
                    class=" h-7 hover:bg-gray-400 text-gray-800 " />
            </li>
            <li>
                <x-buttonConnexion path="{{ url('/dashboard') }}" action='Espace Client'
                    class=" h-7 bg-red_custom hover:bg-white text-gray-800" />
            </li>
        @else
            <li>
                <x-buttonConnexion path="{{ route('login') }}" action='Se connecter'
                    class=" h-7 bg-green-200 hover:bg-gray-400 text-gray-800" />
            </li>

            @if (Route::has('register'))
                <li>
                    <x-buttonConnexion path="{{ route('register') }}" action='Créer un compte'
                        class=" h-7  hover:bg-gray-400 text-gray-800" />
                </li>
            @endif
        @endauth  
        <a href="#" class="font-semibold py-1 px-4 mr-3"><img src="{{asset('img/picto_panier.png')}}" alt="panier"></a>
        <a href="{{ route('login') }}" class="font-semibold py-1 px-4 mr-3"><img src="{{asset('img/picto_pays.png')}}" alt="panier"></a>
       
        
    @endif
</ul>
</div>
