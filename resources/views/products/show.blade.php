@extends('layouts.app-index')

@section('css')

    <style>
        input[type='number']::-webkit-inner-spin-button,
        input[type='number']::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

    </style>
@endsection

@section('navbar')
    <x-navbar-sub :categoriesParent="$categoriesParent" />
@endsection

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

                    @canany(['edit', 'delete'])
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
                    @endcanany

                    <h3 class="text-gray-400 italic text-md text-center md:text-left mb-4 md:mb-6">{{ $products->color }}
                    </h3>
                    <span>{{ $products->ref }}</span>
                    <p class="text-gray-500 sm:text-lg mb-6 md:mb-8">
                        {{ $products->description }}
                    </p>



                    <div class="w-full">
                        <div class="custom-number-input h-7 w-32 flex items-center m-3">
                            <label for="quantity" class="w-full underline text-gray-700 text-sm font-semibold">Quantité:
                            </label>
                            <div class="flex flex-row h-7 w-full rounded-lg relative bg-transparent mt-1">

                                <button onclick="decrement(this)" data-action="decrement"
                                    class=" ml-2 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-l cursor-pointer outline-none">
                                    <span class="m-auto text-md font-thin">−</span>
                                </button>
                                <input type="number" name="quantity" min="0"
                                    class="focus:outline-none text-center w-full border-none font-semibold text-md hover:text-black focus:text-black  md:text-basecursor-default flex items-center text-gray-700  outline-none"
                                    value="0" />
                                <button onclick="increment(this)" data-action="increment"
                                    class=" text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-r cursor-pointer">
                                    <span class="m-auto text-md font-thin">+</span>
                                </button>

                            </div>
                        </div>
                    </div>


                    <div
                        class="relative max-w-sm md:min-w-[340px] bg-white shadow-md rounded-3xl p-2 mx-1 my-3 cursor-pointer">
                        <div class="mt-4 pl-2 mb-2 flex flex-col lg:flex-row justify-between ">
                            <div>
                                <p class="text-lg text-gray-900 mb-0">Prix à l'unité</p>

                                <p class="text-md font-bold text-gray-800 mt-0">

                                    @if (Count(Auth::user()->customers))
                                        {{ number_format( 
                                            $products->unit_price_HT * (1 + (Auth::user()->customers[0]->coefficient/100))
                                            , 2, ',', ' ')
                                        }}
                                    @elseif(Auth::user()->employees)
                                        {{number_format( 
                                           $products->unit_price_HT * (1 + (Auth::user()->employees[0]->coefficient/100))
                                           , 2, ',', ' ')
                                        }}
                                    @else
                                        {{ $products->unit_price_HT }}
                                    @endif
                                    € <small> hors taxe</small>
                                </p>
                            </div>
                        

                        <div class="flex md:flex-col md:mt-0 mt-2 mb-1 mr-4 group ">
                            <a href="#" id="like" class='cursor-pointer md:px-0 px-2 hover:opacity-90 opacity-70'>
                                <i class="far fa-heart"></i>
                            </a>
                            <form action="{{ route('basket.store') }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $products->id }}">
                                <input type="hidden" name="label" value="{{ $products->label }}">
                                <input type="hidden" name="price" value="{{ $products->unit_price_HT }}">
                                <button type="submit" id="addToCart" class='cursor-pointer  hover:opacity-90 opacity-70'>
                                    <i class="fas fa-shopping-cart"></i>
                                </button>
                            </form>

                        </div>
</div>
                    </div>




                </div>
            </div>
        </div>

    @endsection

    @section('js_footer')

        <script>
            function decrement(e) {
                const btn = document.querySelector('button[data-action="decrement"]');
                const target = btn.nextElementSibling;
                let value = Number(target.value);
                if (value > 0) {
                    value--;
                    target.value = value;
                } else {
                    alert('La quantité ne peut être négative !')
                }

            }

            function increment(e) {
                const btn = document.querySelector('button[data-action="increment"]');
                const target = btn.previousElementSibling;
                let value = Number(target.value);
                value++;
                target.value = value;
            }

            /* const decrementButtons = document.querySelectorAll(
                 `button[data-action="decrement"]`
             );

             const incrementButtons = document.querySelectorAll(
                 `button[data-action="increment"]`
             );

             decrementButtons.forEach(btn => {
                 btn.addEventListener("click", decrement);
             });

             incrementButtons.forEach(btn => {
                 btn.addEventListener("click", increment);
             });*/
        </script>
    @endsection
