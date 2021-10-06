<div style="z-index: 1000" class="hidden absolute left-0 w-full  max-w-2xl p-5 mx-auto my-auto rounded-xl shadow-lg  bg-gray-200 ">

    <div class="flex flex-col flex-1 text-center p-5 justify-between border-gray-300 border-r-2">


        <h3 class="text-xl font-semi-bold py-4 justify-self-start">Êtes vous déjà client chez nous ?</h3>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="block mt-4">
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autofocus />

                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Rester connecté') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button class="ml-4">
                    {{ __('Se connecter maintenant') }}
                </x-jet-button>

                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900"
                        href="{{ route('password.request') }}">
                        {{ __('Mot de Passe oublié ?') }}
                    </a>
                @endif

            </div>
        </form>
    </div>


    <div class="flex flex-col flex-1 text-center p-5 flex justify-center border-gray-300 border-l-2">


        <h3 class="text-xl font-semi-bold py-4 justify-self-start">N'Êtes vous pas encore client ?</h3>
        <p>En tant que client Village Green vous popuvez suivre vos envoies, lire des tests produits exclusifs,
            évaluer des produits, déposeeds petites annonces, gérer vos chèques cadeaux, devenri partenaires
            et bien plus encore .
        </p>
        @if (Route::has('register'))
                    <x-button path="{{ route('register') }}" action="S'inscrire"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest 
                        hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition ml-4" />
            @endif
        
    </div>


</div>