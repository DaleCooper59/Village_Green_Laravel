@extends('layouts.app-index')

@section('navbar')
    <x-navbar-sup-index />
    <x-navbar-index />
    <div
        class="relative flex items-center justify-end w-full h-20 my-0 overflow-auto bg-gray-700 text-white font-semibold text-sm sm:pt-0" style="
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

    @foreach ($products as $product)
        <p>{{ $product->label }}</p>
        <p>{{ $product->EAN }}</p>
    @endforeach

    @auth
        <p>je suis connecté</p>
    @endauth
@endsection
