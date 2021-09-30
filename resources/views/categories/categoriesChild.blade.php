@extends('layouts.app-index')

@section('content')
    <main class="container mx-auto px-12 md:px-20 h-min-full mt-36 md:mt-44">
        <div class="bg-white py-6 sm:py-8 lg:py-12 my-4 shadow-sm">
            <div class="max-w-screen-2xl px-4 md:px-8 mx-auto">
                <div class="flex flex-col justify-between gap-8 mb-4 sm:mb-8 md:mb-12">
                    @if (count($categories) !== 0)
                        @foreach ($categories as $category)
                            <x-small-card path="{{ route('categories.show', $category->id) }}"
                                name='{{ $category->name }}' src='https://source.unsplash.com/random' />
                        @endforeach
                    @else
                        <div class=" text-2xl text-green-700 ">Il n'y a aucune catégorie pour cette catégorie parente</div>
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection
