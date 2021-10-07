@extends('layouts.app-index')


@section('navbar')
    <x-navbar-sub  :categoriesParent="$categoriesParent"/>
@endsection

@section('content')
    <div class="bg-white mt-10 py-10 sm:py-16 lg:py-24">
        <div class="max-w-screen-2xl px-4 md:px-8 mx-auto">

            <div class="mb-10 md:mb-16">
                <h2 class="text-gray-800 text-2xl lg:text-3xl font-bold text-center mb-4 md:mb-6">Formulaire d'édition du
                    produit</h2>

            </div>

            <!-- form - start -->
            <form method="post" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data"
                class="max-w-screen-md grid sm:grid-cols-2 gap-4 mx-auto">
                @csrf
                @method('PATCH')

                <!----label---->
                <div>
                    <label for="label" class="inline-block text-gray-800 text-sm sm:text-base mb-2">Nom du Produit</label>
                    <input name="label" id="label" type="text" value="{{ $product->label }}"
                        placeholder="{{-- $product->label --}}"
                        class="w-full bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2 placeholder-gray-300" />

                    @error('label')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!----ref---->
                <div>
                    <label for="ref" class="inline-block text-gray-800 text-sm sm:text-base mb-2">Référence produit</label>
                    <input name="ref" id="ref" type="text" value="{{ $product->ref }}" placeholder="{{-- $product->ref --}}"
                        class="w-full bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2 placeholder-gray-300" />

                    @error('ref')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!----picture---->
                <div class="sm:col-span-2">
                    <label for="picture" class="inline-block text-gray-800 text-sm sm:text-base mb-2">Photo du
                        produit</label>
                    <input name="picture" id="picture" name="picture" type="file" value="{{ $product->picture }}" accept="image/png, image/jpeg"
                        class="w-full bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2" />

                    @error('picture')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!----description---->
                <div class="sm:col-span-2">
                    <label for="description"
                        class="inline-block text-gray-800 text-sm sm:text-base mb-2">Description</label>
                    <textarea name="description" id="description" type="text" name="description"
                        placeholder="{{-- $product->description --}}"
                        class="w-full bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2 placeholder-gray-300">{{ $product->description }}</textarea>

                    @error('description')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!----EAN---->
                <div>
                    <label for="EAN" class="inline-block text-gray-800 text-sm sm:text-base mb-2">Code barre</label>
                    <input name="EAN" id="EAN" type="text" value="{{ $product->EAN }}" placeholder="{{-- $product->EAN --}}"
                        class="w-full bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2 placeholder-gray-300" />

                    @error('EAN')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!----color---->
                <div>
                    <label for="color" class="inline-block text-gray-800 text-sm sm:text-base mb-2">Couleur(s) du
                        produit</label>
                    <input name="color" id="color" type="text" value="{{ $product->color }}"
                        placeholder="{{-- $product->color --}}"
                        class="w-full bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2 placeholder-gray-300" />

                    @error('color')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!----unit_price_HT---->
                <div class="sm:col-span-2">
                    <label for="unit_price_HT" class="inline-block text-gray-800 text-sm sm:text-base mb-2">Prix unitaire
                        hors taxe proposé à la vente</label>
                    <input name="unit_price_HT" id="unit_price_HT" type="number" min="0" step=".01"
                        value="{{ $product->unit_price_HT }}" placeholder="{{-- $product->unit_price_HT --}}"
                        class="w-full bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2 placeholder-gray-300" />

                    @error('unit_price_HT')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!----supply_ref---->
                <div>
                    <label for="supply_ref" class="inline-block text-gray-800 text-sm sm:text-base mb-2">Référence produit
                        fournisseur</label>
                    <input name="supply_ref" id="supply_ref" type="text" value="{{ $product->supply_ref }}"
                        placeholder="{{-- $product->supply_ref --}}"
                        class="w-full bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2 placeholder-gray-300" />

                    @error('supply_ref')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!----supply_product_name---->
                <div>
                    <label for="supply_product_name" class="inline-block text-gray-800 text-sm sm:text-base mb-2">Nom de
                        produit du fournisseur</label>
                    <input name="supply_product_name" id="supply_product_name" type="text"
                        value="{{ $product->supply_product_name }}" placeholder="{{-- $product->supply_product_name --}}"
                        class="w-full bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2 placeholder-gray-300" />

                    @error('supply_product_name')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!----supply_unit_price_HT---->
                <div class="sm:col-span-2">
                    <label for="supply_unit_price_HT" class="inline-block text-gray-800 text-sm sm:text-base mb-2">Prix
                        unitaire hors taxe du fournisseur</label>
                    <input name="supply_unit_price_HT" id="supply_unit_price_HT" type="number" min="0" step=".01"
                        value="{{ $product->supply_unit_price_HT }}" placeholder="{{-- $product->supply_unit_price_HT --}}"
                        class="w-full bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2 placeholder-gray-300" />

                    @error('supply_unit_price_HT')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!----stock---->
                <div>
                    <label for="stock" class="inline-block text-gray-800 text-sm sm:text-base mb-2">Stock disponible à la
                        vente</label>
                    <input name="stock" id="stock" type="number" min="1" step="1" value="{{ $product->stock }}"
                        placeholder="{{-- $product->stock --}}"
                        class="w-full bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2 placeholder-gray-300" />

                    @error('stock')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!----stock_alert---->
                <div>
                    <label for="stock_alert" class="inline-block text-gray-800 text-sm sm:text-base mb-2">Stock_alert
                        disponible à la vente</label>
                    <input name="stock_alert" id="stock_alert" type="number" min="0" step="1"
                        value="{{ $product->stock_alert }}" placeholder="{{-- $product->stock_alert --}}"
                        class="w-full bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2 placeholder-gray-300" />

                    @error('stock_alert')
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
