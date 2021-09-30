@extends('layouts.app-index')

@php
    use App\Http\Controllers\CategoryController;
    
@endphp
@section('navbar')

    <div id="nav_categories"
        class="relative flex items-center justify-end w-full h-20 my-0 bg-gray-700 text-white font-semibold text-sm sm:pt-0">


        @foreach ($categoriesParent as $category)
            <div x-data="{ open: false }" class="relative">
                <button @click="open = true" class="font-semibold py-1 mx-2 inline-block">{{ $category->name }}</button>
                @if (count($category->children))
                    <ul x-show="open" @click.away="open = false"
                        x-transition:enter="transition ease-out origin-top-left duration-200"
                        x-transition:enter-start="opacity-0 transform scale-90"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition origin-top-left ease-in duration-100"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-90"
                        class="absolute z-30 shadow-sm p-5 rounded mt-2 bg-gray-100">

                        @foreach ($category->children as $item)
                            <li class=" border-b-2 border-gray-300 py-1 text-black">
                                <a href="{{ route('categories.show', $item->id) }}">{{ $item->name }}</a>
                            </li>
                        @endforeach


                    </ul>
                @endif
            </div>

        @endforeach
        <a href="{{ route('categories.index') }}" class="font-semibold py-1 mx-2 inline-block">Tous</a>
    </div>

@endsection

@section('content')
    <main class="container mx-auto px-12 md:px-20 h-min-full mt-36 md:mt-44">
        

        <div class="bg-white py-6 sm:py-8 lg:py-12 my-4 shadow-sm">
            <div class="max-w-screen-2xl px-4 md:px-8 mx-auto">
                <div class="flex justify-between items-center gap-8 mb-4 sm:mb-8 md:mb-12">
                    <div class="flex items-center gap-12">
                        <h1 class="text-6xl font-normal leading-normal mt-0 mb-2 text-gray-300">
                            Catégories principales
                        </h1>

                    </div>

                    <a href="#"
                        class="inline-block bg-white hover:bg-gray-100 active:bg-gray-200 focus-visible:ring ring-indigo-300 border text-gray-500 text-sm md:text-base font-semibold text-center rounded-lg outline-none transition duration-100 px-4 md:px-8 py-2 md:py-3">More</a>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 md:gap-6 xl:gap-8">

                    @foreach ($categoriesParent as $category)
                        <x-small-card path="{{ route('categories.categoriesChild', $category->id) }}"
                            name='{{ $category->name }}' src="{{ asset('img/charte/BODY/' . $category->picture) }}" />
                    @endforeach

                    <!--Button plus------------------------------------------------->
                    <!--au click deploie les catégories suivantes-->
                </div>

            </div>
        </div>



        <div class="bg-white py-6 sm:py-8 lg:py-12 my-4 shadow-sm">
            <div class="max-w-screen-2xl px-4 md:px-8 mx-auto">
                <div class="flex justify-between items-center gap-8 mb-4 sm:mb-8 md:mb-12">
                    <div class="flex items-center gap-12">
                        <h1 class="text-6xl font-normal leading-normal mt-0 mb-2 text-gray-300">
                            Sous catégories
                        </h1>

                    </div>

                    <a href="#"
                        class="inline-block bg-white hover:bg-gray-100 active:bg-gray-200 focus-visible:ring ring-indigo-300 border text-gray-500 text-sm md:text-base font-semibold text-center rounded-lg outline-none transition duration-100 px-4 md:px-8 py-2 md:py-3">More</a>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 md:gap-6 xl:gap-8">

                    @foreach ($categoriesChild as $category)
                        <x-small-card path="{{ route('categories.categoriesChild', $category->id) }}"
                            name='{{ $category->name }}' src='https://source.unsplash.com/random' />
                    @endforeach

                    <!--Button plus------------------------------------------------->
                    <!--au click deploie les catégories suivantes-->
                </div>

            </div>
        </div>


       
        <div class="bg-white py-6 sm:py-8 lg:py-12 my-4 shadow-sm">
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

                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 md:gap-6 xl:gap-8">

                    @foreach ($products as $product)
                       @php
                           //$range = CategoryController::in_range($product->id, 0, 39);
                       
                        if($product->id <=40 ){
                            $src = asset('img/' . $product->picture);  
                        }else{
                             $src =Storage::url($product->picture);
                        }
                        @endphp
                        <x-small-card path="{{ route('products.show', $product->id) }}" name='{{ $product->label }}'
                           src="{{$src}}"
                         />
                          
                    @endforeach

                    <!--Button plus------------------------------------------------->
                    <!--au click deploie les catégories suivantes-->
                </div>

            </div>
        </div>

    </main>
@endsection
