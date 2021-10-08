@extends('layouts.app-index')


@section('navbar')
    <x-navbar-sub  :categoriesParent="$categoriesParent"/>
@endsection

@section('content')

<div class="bg-white py-6 sm:py-8 lg:py-12 my-4 shadow-sm mt-36">
    <div class="max-w-screen-2xl px-4 md:px-8 mx-auto">
        <div class="flex justify-between items-center gap-8 mb-4 sm:mb-8 md:mb-12">
            <div class="flex items-center gap-12">
                <h1 class="text-6xl font-normal leading-normal mt-0 mb-2 text-gray-300">
                    Tous les produits
                </h1>

            </div>

            <a href="#"
                class="inline-block bg-white hover:bg-gray-100 active:bg-gray-200 focus-visible:ring ring-indigo-300 border text-gray-500 text-sm md:text-base font-semibold text-center rounded-lg outline-none transition duration-100 px-4 md:px-8 py-2 md:py-3">More</a>
        </div>

        <div class="relative grid grid-cols-2 sm:grid-cols-3 gap-4 md:gap-6 xl:gap-8">

            @foreach ($products as $product)
                @php
                    //$range = CategoryController::in_range($product->id, 0, 39);
                    
                    if ($product->id <= 40) {
                        $src = asset('img/' . $product->picture);
                    } else {
                        $src = Storage::url($product->picture);
                    }
                @endphp
                <x-small-card  path="{{ route('products.show', $product->id) }}" name='{{ $product->label }}'
                    src="{{ $src }}" >
                    <x-button-group-edit-delete class="absolute right-0" path="{{ route('products.edit', $product->id) }}"
                        action="Éditer" route="{{ route('products.destroy', $product->id) }}"
                        action2="Effacer" />
                </x-small-card>

            @endforeach

            <!--Button plus------------------------------------------------->
            <!--au click deploie les catégories suivantes-->
        </div>

    </div>
</div>

@endsection