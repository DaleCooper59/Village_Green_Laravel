@extends('layouts.app-index')

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

        @include('layouts/ad_banner')

        @include('layouts/garantie_banner')
        <!--liste categories-->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 my-4">
            @foreach ($categoriesParent as $category)
                <a href="{{ route('categories.categoriesChild', $category->id) }}"
                    class="relative z-30 hover:z-0 text-white">
                    <img class="w-full md:h-52 h-44 bg-white" src="{{ asset('img/charte/BODY/' . $category->picture) }}" alt="">
                    <span
                        class="absolute top-0 left-0 text-md tracking-tight font-medium leading-7 font-regular text-red-900 hover:underline">{{ $category->name }}
                    </span>
                </a>

            @endforeach
        </div>

        <!--liste partenaires-->
        <div class="grid grid-cols-1 lg:grid-cols-2 my-4">
            <div class="col-1">
                <h1>Top Ventes</h1>
                <p id="paraph">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quos, nobis enim accusantium
                    voluptatem exercitationem quaerat quidem
                    est debitis! Minima earum quod est pariatur, ipsum delectus aut blanditiis dolore doloribus sapiente.
                </p>
            </div>
            <div class="col-1">
                <h1>Nos partenaires</h1>
                <img class="w-full h-full bg-white" src="{{ asset('img/charte/BODY/partenaires_4_logos.png') }}"
                    alt="Partenaires">
            </div>

        </div>
        
    </main>
@endsection
