@extends('layouts.app-index')

@section('content')


    <div class="bg-white mt-10 py-10 sm:py-16 lg:py-24">
        <div class="max-w-screen-2xl px-4 md:px-8 mx-auto">

            <div class="mb-10 md:mb-16">
                <h2 class="text-gray-800 text-2xl lg:text-3xl font-bold text-center mb-4 md:mb-6">Inscription au fichier
                    client</h2>

            </div>

            <!-- form - start -->
            <form method="post" action="{{ route('customers.store') }}" enctype="multipart/form-data"
                class="max-w-screen-md grid sm:grid-cols-2 gap-4 mx-auto">
                @csrf

                <!----type---->
                <div>
                    <fieldset>
                        <legend class="inline-block text-gray-800 text-sm sm:text-base mb-2">Type de client*</legend>
                        <input type="radio" name="type" value="particulier">Particulier<br>
                        <input type="radio" name="type" value="professionnel">Professioennel<br>

                    </fieldset>

                    @error('type')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!----street---->
                <div class="sm:col-span-2">
                    <label for="street" class="inline-block text-gray-800 text-sm sm:text-base mb-2">Adresse*</label>
                    <input name="street" id="street" type="text" value="{{ old('street') }}" placeholder="rue jean ..."
                        class="w-full bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2 placeholder-gray-300" />

                    @error('street')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!----city---->
                <div class="flex  justify-center sm:col-span-2">
                    @livewire('search')
                </div>

                <!----country---->
                <div class="flex justify-center sm:col-span-2">
                    @livewire('search-countries')
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
