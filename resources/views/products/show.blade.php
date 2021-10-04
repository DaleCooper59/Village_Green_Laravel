@extends('layouts.app-index')

@section('content')
    <div class="bg-white mt-10 py-10 sm:py-16 lg:py-24">
        <div class="max-w-screen-xl px-4 md:px-8 mx-auto">
            <div class="grid md:grid-cols-2 gap-8 lg:gap-12">
                <div>
                    <div class="h-56 md:h-auto mt-10 bg-gray-100 overflow-hidden rounded-lg shadow-lg">
                        @if ($products->id <= 40)
                            <img src="{{ asset('img/' . $products->picture) }}" loading="lazy"
                                alt="{{ $products->label }}" class="w-full h-full object-cover object-center">
                        @else
                            <img src="{{ Storage::url($products->picture) }}" loading="lazy"
                                alt="{{ $products->label }}" class="w-full h-full object-cover object-center">
                        @endif

                    </div>
                </div>

                <div class="md:pt-8">

                    <h1 class="text-gray-800 text-2xl sm:text-3xl font-bold text-center md:text-left mb-4">
                        {{ $products->label }}</h1>

                    <!------buttons------>
                    <div class="flex ">
                        <x-button path="{{ route('products.edit', $products->id) }} " action='Éditer'
                            class="inline-block m-0 mb-1 font-medium bg-red_custom-light hover:bg-red_custom" />
                        <form action="{{ route('products.destroy', $products->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit"
                                class="py-1 px-4 mr-3 rounded shadow cursor-pointer inline-block m-0 mb-1 font-medium bg-red_custom hover:bg-red_custom-dark text-gray-800">Effacer</button>

                        </form>

                    </div>


                    <h3 class="text-gray-400 italic text-md text-center md:text-left mb-4 md:mb-6">{{ $products->color }}
                    </h3>
                    <span>{{ $products->ref }}</span>
                    <p class="text-gray-500 sm:text-lg mb-6 md:mb-8">
                        {{ $products->description }}
                    </p>

                    <div
                        class="relative max-w-sm min-w-[340px] bg-white shadow-md rounded-3xl p-2 mx-1 my-3 cursor-pointer">

                        <div class="mt-4 pl-2 mb-2 flex justify-between ">
                            <div>
                                <p class="text-lg text-gray-900 mb-0">Prix à l'unité</p>
                                <p class="text-md font-bold text-gray-800 mt-0">{{ $products->unit_price_HT }} Euros</p>
                            </div>
                            <div class="flex flex-col-reverse mb-1 mr-4 group ">
                                <a href="#" class='cursor-pointer'>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-6 w-6 group-hover:opacity-50 opacity-70" fill="none" viewBox="0 0 24 24"
                                        stroke="black">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </a>
                                <a href="#" class='cursor-pointer'>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 group-hover:opacity-70"
                                        fill="none" viewBox="0 0 24 24" stroke="gray">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </a>


                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
