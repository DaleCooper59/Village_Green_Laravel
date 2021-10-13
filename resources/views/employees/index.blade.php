<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Formulaire employé') }}
        </h2>
        <div class="flex mt-3">
            <x-button path="{{ route('dashboard') }}" action='Administration'
            class="bg-gray-200 w-auto inline-block hover:bg-gray-400 text-gray-800 border-gray-400">
            <x-slot name="icon"> <i class="fas fa-home"></i>
            </x-slot>
        </x-button>
    
        </div>
        
    </x-slot>

    <div class="bg-white mt-10 py-10 sm:py-16 lg:py-24">
        <div class="max-w-screen-2xl px-4 md:px-8 mx-auto">

          
            <!-- form - start -->
            <form method="post" action="{{ route('employees.store') }}" 
                class="max-w-screen-md grid sm:grid-cols-2 gap-4 mx-auto">
                @csrf

                <!----department---->
                <div>
                    <fieldset>
                        <legend class="inline-block text-gray-800 text-sm sm:text-base mb-2">Type de vendeur</legend>
                        <input type="radio" name="department" value="particulier" >Vendeur particulier<br>
                        <input type="radio" name="department" value="professionnel" >Vendeur professioennel<br>
                       
                    </fieldset>

                    @error('department')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!----submit---->
                <div class="sm:col-span-2 flex justify-between items-center">
                    <button type="submit"
                        class="font-semibold py-1 px-4 mr-3 rounded shadow cursor-pointer inline-block m-0 mb-1 font-medium bg-red_custom-light hover:bg-red_custom">Ajouter</button>
                    <!----required---->
                    <span class="text-gray-500 text-sm">*Champs requis</span>
                </div>

            </form>
            <!-- form - end -->
        </div>
    </div>



</x-app-layout>
