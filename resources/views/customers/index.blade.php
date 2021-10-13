@extends('layouts.app-index')

@section('content')

    
<div class="bg-white mt-10 py-10 sm:py-16 lg:py-24">
    <div class="max-w-screen-2xl px-4 md:px-8 mx-auto">

        <div class="mb-10 md:mb-16">
            <h2 class="text-gray-800 text-2xl lg:text-3xl font-bold text-center mb-4 md:mb-6">Inscription au fichier client</h2>

        </div>

        <!-- form - start -->
        <form method="post" action="{{ route('customers.store') }}" enctype="multipart/form-data"
            class="max-w-screen-md grid sm:grid-cols-2 gap-4 mx-auto">
            @csrf

         <!----type---->
         <div>
            <fieldset>
                <legend class="inline-block text-gray-800 text-sm sm:text-base mb-2">Type de client</legend>
                <input type="radio" name="type" value="particulier" >Particulier<br>
                <input type="radio" name="type" value="professionnel" >Professioennel<br>
               
            </fieldset>

            @error('type')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>

            <!----street---->
            <div class="sm:col-span-2">
                <label for="street" class="inline-block text-gray-800 text-sm sm:text-base mb-2">Adresse</label>
                <input name="street" id="street" type="text" value="{{ old('street') }}" placeholder="rue jean ..."
                    class="w-full bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2 placeholder-gray-300" />

                @error('street')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!----city---->
            <div>
                <label for="city" class="inline-block text-gray-800 text-sm sm:text-base mb-2">Ville</label>
                <input type="search" name="search" id="city"
                class="py-2 text-sm bg-gray-50 rounded-md pl-10 focus:outline-none focus:bg-white focus:text-gray-900"
                placeholder="Search..." autocomplete="off" value="{{ request('search') }}">

                @error('city')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!----country---->
            <div>
                <label for="country" class="inline-block text-gray-800 text-sm sm:text-base mb-2">Couleur(s) du
                    produit</label>
                    <select name="parent_id" id="parent_id" class="w-full bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2 placeholder-gray-300">

                       {{-- @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach--}}
                        <input name="country" id="country" type="text" value="{{ old('country') }}"
                        placeholder="fushia"
                        class="w-full bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2 placeholder-gray-300" />
                    </select>
               
                @error('country')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!----unit_price_HT---->
            <div class="sm:col-span-2">
                <label for="unit_price_HT" class="inline-block text-gray-800 text-sm sm:text-base mb-2">Prix unitaire
                    hors taxe proposé à la vente*</label>
                <input name="unit_price_HT" id="unit_price_HT" type="number" min="0" step=".01"
                    value="{{ old('unit_price_HT') }}" placeholder="30.99"
                    class="w-full bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2 placeholder-gray-300" />

                @error('unit_price_HT')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!----supply_ref---->
            <div>
                <label for="supply_ref" class="inline-block text-gray-800 text-sm sm:text-base mb-2">Référence produit
                    fournisseur*</label>
                <input name="supply_ref" id="supply_ref" type="text" value="{{ old('supply_ref') }}"
                    class="w-full bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2 placeholder-gray-300" />

                @error('supply_ref')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!----supply_product_name---->
            <div>
                <label for="supply_product_name" class="inline-block text-gray-800 text-sm sm:text-base mb-2">Nom de
                    produit du fournisseur*</label>
                <input name="supply_product_name" id="supply_product_name" type="text"
                    value="{{ old('supply_product_name') }}" 
                    class="w-full bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2 placeholder-gray-300" />

                @error('supply_product_name')
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

  @endsection     