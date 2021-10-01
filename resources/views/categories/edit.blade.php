@extends('layouts.app-index')

@section('content')
    <div class="bg-white mt-10 py-10 sm:py-16 lg:py-24">
        <div class="max-w-screen-2xl px-4 md:px-8 mx-auto">

            <div class="mb-10 md:mb-16">
                <h2 class="text-gray-800 text-2xl lg:text-3xl font-bold text-center mb-4 md:mb-6">Formulaire d'édition de la
                    catégorie : {{ $category->name }}</h2>

            </div>

            <!-- form - start -->
            <form method="post" action="{{ route('categories.update', $category->id) }}" enctype="multipart/form-data"
                class="max-w-screen-md grid sm:grid-cols-2 gap-4 mx-auto">
                @csrf
                @method('PATCH')

                <!----name---->
                <div>
                    <label for="name" class="inline-block text-gray-800 text-sm sm:text-base mb-2">Nom de la
                        cétagorie*</label>
                    <input name="name" id="name" type="text" value="{{ $category->name }}" placeholder="Violon"
                        class="w-full bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2 placeholder-gray-300" />

                    @error('name')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                @if ($category->parent_id !== null)
                    <!----parent_id---->
                    <div>
                        <label for="parent_id" class="inline-block text-gray-800 text-sm sm:text-base mb-2">Catégorie
                            parente*</label>

                        <select name="parent_id" id="parent_id"
                            class="w-full bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2 placeholder-gray-300">
                            <option value=""></option>
                            @foreach ($categoriesParent as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('parent_id')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                @endif

                <!----picture---->
                <div class="sm:col-span-2">
                    <label for="picture" class="inline-block text-gray-800 text-sm sm:text-base mb-2">Photo de
                        la catégorie*</label>
                    <input name="picture" id="picture" name="picture" type="file" value="{{ old('picture') }}"
                        class="w-full bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2" />

                    @error('picture')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <!----submit---->
                <div class="sm:col-span-2 flex justify-between items-center">
                    <button type="submit"
                        class="font-semibold py-1 px-4 mr-3 rounded shadow cursor-pointer inline-block m-0 mb-1 font-medium bg-red_custom-light hover:bg-red_custom">Éditer</button>
                    <!----required---->
                    <span class="text-gray-500 text-sm">*Champs requis</span>
                </div>

            </form>
            <!-- form - end -->
        </div>
    </div>
@endsection
