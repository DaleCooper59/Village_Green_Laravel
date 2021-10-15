<div class="flex flex-col justify-center items-center my-6 mt-36">

    <h1 class="text-6xl self-start font-normal leading-normal mt-0 mb-10 text-blueGray-800 ">
        Votre panier
    </h1>
    <div class="flex flex-col w-full p-8 text-gray-800 bg-white shadow-lg pin-r pin-y md:w-4/5 ">
        <div class="flex-1">
            <table class="w-full text-sm lg:text-base" cellspacing="0">
                <thead>
                    <tr class="h-12 uppercase">
                        <th class="hidden md:table-cell"></th>
                        <th class="text-left">Produit(s)</th>
                        <th class="lg:text-right text-left pl-5 lg:pl-0">
                            <span class="lg:hidden" title="Quantity">Qté</span>
                            <span class="hidden lg:inline">Quantité</span>
                        </th>
                        <th class="hidden text-right md:table-cell">Prix unitaire hors taxe</th>
                        <th class="text-right">Prix total HT</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rows as $row)

                        <tr>
                            <td class="hidden pb-4 md:table-cell">
                                <a href="#">
                                    @for ($i = 0; $i < count($products); $i++)

                                        @if ($row->id == $products[$i][0]['id'])
                                            @if ($row->id < 39)
                                                <img src="{{ asset('img/' . $products[$i][0]->picture) }}"
                                                    class="w-20 rounded" alt="Thumbnail">
                                            @else
                                                <img src="{{ Storage::url($products[$i][0]->picture) }}"
                                                    class="w-20 rounded" alt="Thumbnail">
                                            @endif
                                        @endif
                                    @endfor
                                </a>
                            </td>
                            <td>


                                <a href="#" wire:click="removeFromCart('{{ $row->rowId }}');">
                                    <p class="mb-2 md:ml-4 text-sm">{{ $row->name }}</p>
                                    <div>
                                        <input type="submit" class="text-gray-700 md:ml-4" />
                                        <i class="far fa-trash-alt"></i>

                                    </div>
                                </a>
                            </td>
                            <td class="justify-center md:justify-end md:flex mt-6">
                                <div class="w-20 h-10">
                                    <div class="relative flex flex-row justify-center items-center w-full h-8">

                                        <a href="#"
                                            wire:click="decrementQuantity('{{ $row->rowId }}', '{{ $row->qty }}');"
                                            class="block ml-2 border-0 text-gray-600 hover:text-gray-700 bg-gray-100 hover:bg-gray-300 rounded-l cursor-pointer outline-none">
                                            −
                                        </a>
                                        <input type="text" id="quantity" name="quantity" min="1"
                                            class="w-16 font-semibold text-center text-gray-700  border-0 outline-none focus:outline-none hover:text-black focus:text-black"
                                            value="{{ $row->qty }}" />
                                        <a href="#"
                                            wire:click="incrementQuantity('{{ $row->rowId }}', '{{ $row->qty }}');"
                                            class="block border-0 text-gray-600 hover:text-gray-700 bg-gray-100 hover:bg-gray-300 rounded-r cursor-pointer">
                                            +
                                        </a>

                                    </div>
                                </div>
                            </td>
                            <td class="hidden text-right md:table-cell">
                                <span class="text-sm lg:text-base font-medium">
                                    {{ $row->price }}
                                </span>
                            </td>

                            <td class="text-right">
                                <span class="text-sm lg:text-base font-medium">
                                    {{ number_format($row->price * $row->qty, 2, ',', ' ') }}
                                    €
                                </span>
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
            <hr class="pb-6 mt-6">
            <form action="{{ route('orders.create') }}" method="get">
                @csrf

                <div class="my-4 mt-6 -mx-2 lg:flex">
                    <div class="lg:px-2 lg:w-1/2">
                        <div class="p-4 bg-gray-100 rounded-full">
                            <h1 class="ml-2 font-bold uppercase">Code coupons, réductions, ...</h1>
                        </div>
                        <div class="p-4">
                            <p class="mb-4 italic">Entrez le code juste en dessous</p>
                            <div class="justify-center md:flex">

                                <div class="flex items-center w-1/4 h-13 pl-3  bg-gray-100 border rounded-full">
                                    <input type="coupon" name="code" id="coupon" placeholder="Appliquer" value="SUPER10"
                                        class="w-full bg-gray-100 outline-none appearance-none focus:outline-none active:outline-none" />

                                </div>

                            </div>
                        </div>
                        <div class="p-4 mt-6 bg-gray-100 rounded-full">
                            <h1 class="ml-2 font-bold uppercase">Instruction pour le vendeur</h1>
                        </div>
                        <div class="p-4">
                            <p class="mb-4 italic">Inscrivez en dessous vos instructions si besoin</p>
                            <textarea class="w-full h-24 p-2 bg-gray-100 rounded"></textarea>
                        </div>
                    </div>


                    <div class="lg:px-2 lg:w-1/2">

                        <div class="p-4 bg-gray-100 rounded-full">
                            <h1 class="ml-2 font-bold uppercase">Montant de la commande</h1>
                        </div>
                        <div class="p-4">
                            <p class="mb-6 italic">Les coûts additionnels ainsi que ceux relatifs à la livraison
                                seront calculés en fonction des produits et dela quantité choisie</p>
                            <div class="flex justify-between border-b">
                                <div class="lg:px-4 lg:py-2 m-2 text-lg lg:text-xl font-bold text-center text-gray-800">
                                    Sous total
                                </div>
                                <input id="subTotal" value="{{ Cart::subtotal() }}"
                                    class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-400 focus:outline-none">


                            </div>

                           
                            <div class="flex justify-between pt-4 border-b">
                                <div class="lg:px-4 lg:py-2 m-2 text-lg lg:text-xl font-bold text-center text-gray-800">
                                    Taxe ( 19.6 %)
                                </div>
                                <input id="subTotalWithTva" value="{{ Cart::tax() }} €"
                                    class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-400 focus:outline-none">

                            </div>
                            <div class="flex justify-between pt-4 border-b">
                                <div class="lg:px-4 lg:py-2 m-2 text-lg lg:text-xl font-bold text-center text-gray-800">
                                    Total
                                </div>
                                <input id="total" value="{{ Cart::total() }} €"
                                    class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-400 focus:outline-none">

                            </div>
                            <a href="#">
                                <button type="submit"
                                    class="flex justify-center w-full px-10 py-3 mt-6 font-medium text-white uppercase bg-gray-800 rounded-full shadow item-center hover:bg-gray-700 focus:shadow-outline focus:outline-none">
                                    <svg aria-hidden="true" data-prefix="far" data-icon="credit-card"
                                        class="w-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                        <path fill="currentColor"
                                            d="M527.9 32H48.1C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48.1 48h479.8c26.6 0 48.1-21.5 48.1-48V80c0-26.5-21.5-48-48.1-48zM54.1 80h467.8c3.3 0 6 2.7 6 6v42H48.1V86c0-3.3 2.7-6 6-6zm467.8 352H54.1c-3.3 0-6-2.7-6-6V256h479.8v170c0 3.3-2.7 6-6 6zM192 332v40c0 6.6-5.4 12-12 12h-72c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h72c6.6 0 12 5.4 12 12zm192 0v40c0 6.6-5.4 12-12 12H236c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h136c6.6 0 12 5.4 12 12z" />
                                    </svg>
                                    <span class="ml-2 mt-5px">Payer la commande</span>
                                </button>
                            </a>
                        </div>

                    </div>

                </div>
            </form>
        </div>
    </div>

</div>
