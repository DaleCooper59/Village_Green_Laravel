@extends('layouts.app-index')


@section('navbar')
    <x-navbar-sub :categoriesParent="$categoriesParent" />
@endsection

@section('content')

    <div class="bg-white mt-10 py-10 sm:py-16 lg:py-24">
        <div class="max-w-screen-2xl px-4 md:px-8 mx-auto">

            <div class="mb-10 md:mb-16">
                <h2 class="text-gray-800 text-2xl lg:text-4xl font-bold text-center mb-4 md:mb-6">Commande en cours</h2>

            </div>

            <!----ProductsList---->
            <div class="flex flex-col justtify-center my-24">
                <h3 class="text-2xl font-normal leading-normal mt-0 mb-2 text-red-700">
                    Rappel de la commande
                </h3>

                <div>
                    <table class="min-w-full table-auto">
                        <thead class="justify-between">
                            <tr class="bg-gray-800">
                                <th class="px-16 py-2">
                                    <span class="text-gray-300">Name</span>
                                </th>

                                <th class="px-16 py-2">
                                    <span class="text-gray-300">Quantité</span>
                                </th>

                                <th class="px-16 py-2">
                                    <span class="text-gray-300">Prix </span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-200">
                            @foreach ($rows as $row)
                                <tr class="bg-white border-4 border-gray-200">


                                    <td class="px-16 py-2 text-center">
                                        {{ $row->name }}
                                    </td>
                                    <td class="px-16 py-2 text-center">
                                        {{ $row->qty }}
                                    </td>
                                    <td class="px-16 py-2 text-center">
                                        {{ number_format($row->price * $row->qty, 2, ',', ' ') }}
                                        €
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-gray-800">
                            <tr>
                                <th class="px-16 py-2"></th>
                                <th class="px-16 py-2"><span class="text-gray-300">Quantité totale :
                                        {{ Cart::count() }} </span></th>
                                <th class="px-16 py-2"><span class="text-gray-300">Prix total :
                                        {{ $priceWithReduction }} € ttc</span></th>
                            </tr>

                        </tfoot>
                    </table>
                    <small>*Réduction de {{ $reduction }} % inclus</small>
                </div>
            </div>


            <!-- form - start -->
            <form method="post" action="{{ route('orders.store') }}" enctype="multipart/form-data"
                class="max-w-screen-md grid sm:grid-cols-2 gap-4 mx-auto">
                @csrf
                <input type="hidden" name="reduction" value="{{ $reduction }}">
                <input type="hidden" name="priceWithReduction" value="{{ $priceWithReduction }}">

                <!----paymentMethod---->
                <div class="relative inline-flex sm:col-span-2">
                    <select name="paymentMethod" id="paymentMethod"
                        class="border border-gray-300 rounded-full text-gray-600 h-10 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none">
                        <option selected="selected">--Choisissez une méthode de paiement--</option>

                        @for ($i = 0; $i < Count($paymentMethod); $i++)
                            <option value="{{ $paymentMethod[$i] }}">{{ $paymentMethod[$i] }} </option>
                        @endfor

                    </select>

                    @error('paymentMethod')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!----address---->
                <div class="sm:col-span-2">
                    <label for="address" class="inline-block text-gray-800 text-sm sm:text-base mb-2">Adresse
                        postale</label>
                    <textarea name="address" id="address" type="text" name="address"
                        class="w-full bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2 placeholder-gray-300">
                             @if (isset($addressEmployee->street))
                             {{ $addressEmployee->street }} 
                             {{ $addressEmployee->city->postal_code . ' ' . $addressEmployee->city->name }}
                     @else
                               {{ $address->street }} 
                            {{ $address->city->postal_code . ' ' . $address->city->name }}
                             @endif
                                </textarea>


                </div>
                <!----deliveryAddress---->
                <div class="sm:col-span-2">
                    <label for="deliveryStreet" class="block text-gray-800 text-sm sm:text-base mb-2">Adresse de
                        livraison</label>
                    <input name="deliveryStreet" id="deliveryStreet" type="text" @if (isset($addressEmployee->street))
                    value="{{ $addressEmployee->street }}"
                @else
                    value="{{ $address->street }}"
                    @endif
                    class="w-1/3 bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2 placeholder-gray-300"
                    />
                    <div class="flex w-1/3  justify-center sm:col-span-2">
                        @livewire('search')
                    </div>

                    @error('deliveryAddress')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!----submit---->
                <div class="sm:col-span-2 flex justify-between items-center">
                    <button type="submit"
                        class="font-semibold py-1 px-4 mr-3 rounded shadow cursor-pointer inline-block m-0 mb-1 font-medium bg-red_custom-light hover:bg-red_custom">Ajouter</button>
                    <!----required---->
                    <span class="text-gray-500 text-sm">*Champs requis</span>
                </div>

            </form>
            <!-- form - end -->
        </div>
    </div>


@endsection
