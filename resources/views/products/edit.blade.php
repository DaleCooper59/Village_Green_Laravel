@extends('layouts.app-index')

@section('content')
    <div class="bg-white mt-10 py-10 sm:py-16 lg:py-24">
        <div class="max-w-screen-2xl px-4 md:px-8 mx-auto">

            <div class="mb-10 md:mb-16">
                <h2 class="text-gray-800 text-2xl lg:text-3xl font-bold text-center mb-4 md:mb-6">Formulaire d'édition du
                    produit</h2>

            </div>

            <!-- form - start -->
            <form method="post" action="{{ route('products.update') }}" enctype="multipart/form-data"
                class="max-w-screen-md grid sm:grid-cols-2 gap-4 mx-auto">
                @csrf
                <div>
                    <label for="first-name" class="inline-block text-gray-800 text-sm sm:text-base mb-2">First name*</label>
                    <input name="first-name"
                        class="w-full bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2" />
                </div>

                <div>
                    <label for="last-name" class="inline-block text-gray-800 text-sm sm:text-base mb-2">Last name*</label>
                    <input name="last-name"
                        class="w-full bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2" />
                </div>

                <div class="sm:col-span-2">
                    <label for="company" class="inline-block text-gray-800 text-sm sm:text-base mb-2">Company</label>
                    <input name="company"
                        class="w-full bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2" />
                </div>

                <div class="sm:col-span-2">
                    <label for="email" class="inline-block text-gray-800 text-sm sm:text-base mb-2">Email*</label>
                    <input name="email"
                        class="w-full bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2" />
                </div>

                <div class="sm:col-span-2">
                    <label for="subject" class="inline-block text-gray-800 text-sm sm:text-base mb-2">Subject*</label>
                    <input name="subject"
                        class="w-full bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2" />
                </div>

                <div class="sm:col-span-2">
                    <label for="message" class="inline-block text-gray-800 text-sm sm:text-base mb-2">Message*</label>
                    <textarea name="message"
                        class="w-full h-64 bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2"></textarea>
                </div>

                <div class="sm:col-span-2 flex justify-between items-center">
                    <a href="#"
                        class="inline-block bg-indigo-500 hover:bg-indigo-600 active:bg-indigo-700 focus-visible:ring ring-indigo-300 text-white text-sm md:text-base font-semibold text-center rounded-lg outline-none transition duration-100 px-8 py-3">Send</a>

                    <span class="text-gray-500 text-sm">*Required</span>
                </div>

                <p class="text-gray-400 text-xs">
                    By signing up to our newsletter you agree to our <a href="#"
                        class="hover:text-indigo-500 active:text-indigo-600 underline transition duration-100">Pricacy
                        Policy</a>.
                </p>
            </form>
            <!-- form - end -->
        </div>
    </div>
@endsection
