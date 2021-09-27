@extends('layouts.app-index')

@section('navbar')
    <x-navbar-sup-index />
    <x-navbar-index />
    <div class="relative flex items-center justify-end w-full h-20 my-0 bg-gray-700 text-white font-semibold text-sm sm:pt-0"
        style="
                    top: 7.5rem; withe-space:no-wrap;">

        @foreach ($categories as $category)
            @if ($category->parent_id === null)
                <a class="font-semibold py-1 mx-2 inline-block"
                    href="{{ route('categories.categoriesChild', $category->id) }}">{{ $category->name }}</a>
            @endif

        @endforeach

    </div>



@endsection

@section('content')
    <h1>Village Green</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4">
        @foreach ($categories as $category)
            <div class="relative z-30 hover:z-0 text-white">
                <img class="w-full h-full bg-gray-500" src="{{ asset('img/charte/BODY/' . $category->picture) }}" alt="">
                <span class="absolute top-0 left-0">
                    <a href="#" class="text-md tracking-tight font-medium leading-7 font-regular text-white hover:underline">{{ $category->name }}</a>
                </span>
                
                
            </div>

        @endforeach
    </div>
    @auth
        <p>je suis connecté</p>
    @endauth
@endsection
