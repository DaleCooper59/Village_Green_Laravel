@extends('layouts.app-index')

@php
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Str;
@endphp

@section('navbar')
    <x-navbar-sub  :categoriesParent="$categoriesParent"/>
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
                        @php
                            if (Str::contains($category->picture, 'picture')) {
                                $link = Storage::url($category->picture);
                            } else {
                                $link = asset('img/charte/BODY/' . $category->picture);
                            }
                        @endphp
                        <x-small-card path="{{ route('categories.categoriesChild', $category->id) }}"
                            name='{{ $category->name }}' src="{{ $link }}">
                            
                            <x-button-group-edit-delete class="absolute right-0" path="{{ route('categories.edit', $category->id) }}"
                                action="Éditer" route="{{ route('categories.destroy', ['category' => $category->id]) }}"
                                action2="Effacer" />
                        </x-small-card>
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

                <div class="relative grid grid-cols-2 sm:grid-cols-3 gap-4 md:gap-6 xl:gap-8">

                    @foreach ($categoriesChild as $category)
                        <x-small-card path="{{ route('categories.show', $category->id) }}" name='{{ $category->name }}'
                            src='https://source.unsplash.com/random'>
                                <x-button-group-edit-delete class="absolute right-0" path="{{ route('categories.edit', $category->id) }}"
                                    action="Éditer" route="{{ route('categories.destroy', $category->id) }}"
                                    action2="Effacer" />
                         
                        </x-small-card>


                    @endforeach

                    <!--Button plus------------------------------------------------->
                    <!--au click deploie les catégories suivantes-->
                </div>

            </div>
        </div>


    </main>
@endsection
