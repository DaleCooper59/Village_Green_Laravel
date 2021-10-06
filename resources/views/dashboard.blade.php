<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panneau d\'administration') }}
        </h2>
    </x-slot>

    <x-button path="{{ route('index') }}" action='Village Green'
        class="bg-white hover:bg-gray-400 text-gray-800 border-gray-400" />
    <x-button path="{{ route('products.create') }}" action='Ajouter un produit'
        class="bg-white hover:bg-gray-400 text-gray-800 border-gray-400" />
    <x-button path="{{ route('categories.create') }}" action='Ajouter une catégorie'
        class="bg-white hover:bg-gray-400 text-gray-800 border-gray-400" />

    <div class="bg-gray-100 h-screen w-auto flex justify-center mt-10">
        <div class="">

            <div class="bg-white max-w-xl mx-auto border border-gray-200" x-data="{selected:null}">

                <div class="relative border-b border-gray-200 shadow-box">

                    <button type="button" class="w-full px-8 py-6 text-left"
                        @click="selected !== 1 ? selected = 1 : selected = null">
                        <div class="flex items-center justify-between">
                            <span>
                               Roles </span>
                               <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                              </svg>
                        </div>
                    </button>

                    <div class="relative overflow-hidden transition-all max-h-0 duration-700" style=""
                        x-ref="container1"
                        x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">
                        <div class="p-6">
                            <p>reCAPTCHA v2 is not going away! We will continue to fully support and improve security
                                and usability for v2.</p>
                            <p>reCAPTCHA v3 is intended for power users, site owners that want more data about their
                                traffic, and for use cases in which it is not appropriate to show a challenge to the
                                user.</p>
                            <p>For example, a registration page might still use reCAPTCHA v2 for a higher-friction
                                challenge, whereas more common actions like sign-in, searches, comments, or voting might
                                use reCAPTCHA v3. To see more details, see the reCAPTCHA v3 developer guide.</p>
                        </div>
                    </div>

                </div>




            </div>

           
            <div class="bg-white max-w-xl mx-auto border border-gray-200" x-data="{selected:null}">


                <div class="relative border-b border-gray-200 shadow-box">

                    <button type="button" class="w-full px-8 py-6 text-left"
                        @click="selected !== 1 ? selected = 1 : selected = null">
                        <div class="flex items-center justify-between">
                            <span>
                                Permissions </span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                  </svg>
                        </div>
                    </button>

                    <div class="relative overflow-hidden transition-all max-h-0 duration-700" style=""
                        x-ref="container1"
                        x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">
                        <div class="p-6">
                            <p>reCAPTCHA v2 is not going away! We will continue to fully support and improve security
                                and usability for v2.</p>
                            <p>reCAPTCHA v3 is intended for power users, site owners that want more data about their
                                traffic, and for use cases in which it is not appropriate to show a challenge to the
                                user.</p>
                            <p>For example, a registration page might still use reCAPTCHA v2 for a higher-friction
                                challenge, whereas more common actions like sign-in, searches, comments, or voting might
                                use reCAPTCHA v3. To see more details, see the reCAPTCHA v3 developer guide.</p>
                        </div>
                    </div>

                </div>




            </div>
        </div>
        

          
       

    </div>

</x-app-layout>
