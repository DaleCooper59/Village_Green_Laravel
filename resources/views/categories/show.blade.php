@extends('layouts.app-index')

@section('content')
    <main class="container mx-auto px-12 md:px-20 h-min-full mt-36 md:mt-44">

        <div class="bg-white py-6 sm:py-8 lg:py-12 my-4 shadow-sm">
            <div class="max-w-screen-2xl px-4 md:px-8 mx-auto">
                <div class="flex justify-between items-center gap-8 mb-4 sm:mb-8 md:mb-12">
                    <div class="flex items-center gap-12">
                        <h1 class="text-6xl font-normal leading-normal mt-0 mb-2 text-gray-300">
                            {{ $category->name }}
                        </h1>

                    </div>

                    <a href="#"
                        class="inline-block bg-white hover:bg-gray-100 active:bg-gray-200 focus-visible:ring ring-indigo-300 border text-gray-500 text-sm md:text-base font-semibold text-center rounded-lg outline-none transition duration-100 px-4 md:px-8 py-2 md:py-3">More</a>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 md:gap-6 xl:gap-8">

                    @if (count($products) !== 0 )
                        @foreach ($products as $product)
                            <x-small-card path="{{ route('products.show', $product->id) }}" name='{{ $product->label }}'
                                src='https://source.unsplash.com/random' />
                        @endforeach

                    @else
                        <div class=" text-2xl text-green-700 ">Il n'y a aucun produit pour cette catégorie</div>
                    @endif
                    <!--Button plus------------------------------------------------->
                    <!--au click deploie les catégories suivantes-->
                </div>

            </div>
        </div>
    </main>
@endsection
