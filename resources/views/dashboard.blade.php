<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panneau d\'administration') }}
        </h2>
    </x-slot>

    <h3 class="text-md font italic text-gray-400">*En fonction de vos paramètres vous pourrez accomplir les actions autorisées, demandez à l'administrateur pour plus de fonctionnalités</h3>
    
    <x-button path="{{ route('index') }}" action='Village Green'
        class="bg-white hover:bg-gray-400 text-gray-800 border-gray-400" />
    <x-button path="{{ route('products.create') }}" action='Ajouter un produit'
        class="bg-white hover:bg-gray-400 text-gray-800 border-gray-400" />
    <x-button path="{{ route('categories.create') }}" action='Ajouter une catégorie'
        class="bg-white hover:bg-gray-400 text-gray-800 border-gray-400" />


    <div class="bg-gray-100 h-screen w-auto flex justify-center mt-10">
        <div class="">

            <div class=" bg-white max-w-xl mx-auto border border-gray-200"
            x-data="{selected:null}">

            <div class="relative border-b border-gray-200 shadow-box">

                <button type="button" class="w-full px-8 py-6 text-left"
                    @click="selected !== 1 ? selected = 1 : selected = null">
                    <div class="flex items-center justify-between">
                        <span>
                            Roles </span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>

                <div class="relative overflow-hidden transition-all max-h-0 duration-700" style="" x-ref="container1"
                    x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">
                    <div class="p-6">
                        @foreach ($roles as $role)
                            <div class="cursor-pointer w-full border-gray-100 rounded-t border-b hover:bg-teal-100">
                                <div
                                    class="flex w-full items-center p-2 pl-2 border-transparent border-l-2 relative hover:border-teal-100">
                                    <div class="w-6 flex flex-col items-center">
                                        <div
                                            class="flex justify-center items-center w-5 h-5 bg-red_custom-light rounded-full ">
                                            {{ $role->id }}</div>
                                    </div>
                                    <div class="w-full ">
                                        <div class="mx-2 -mt-1 block w-full">{{ $role->name }}
                                            <div class="w-full flex justify-center items-end">
                                                <div
                                                    class="text-xs truncate w-full normal-case font-normal -mt-1 text-gray-500">
                                                    description du role ...</div>
                                                <div class="flex ">
                                                    <x-button path="{{ route('roles.edit', $role->id) }} "
                                                        action='Éditer'
                                                        class="inline-block m-0 mb-1 font-medium bg-red_custom-light hover:bg-red_custom" />
                                                    <form action="{{ route('roles.destroy', $role->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit"
                                                            class="py-1 px-4 mr-3 rounded shadow cursor-pointer inline-block m-0 mb-1 font-medium bg-red_custom hover:bg-red_custom-dark text-gray-800">Effacer</button>

                                                    </form>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endforeach


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
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>

                <div class="relative overflow-hidden transition-all max-h-0 duration-700" style="" x-ref="container1"
                    x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">
                    <div class="p-6">
                        @foreach ($permissions as $permission)
                            <div class="cursor-pointer w-full border-gray-100 rounded-t border-b hover:bg-teal-100">
                                <div
                                    class="flex w-full items-center p-2 pl-2 border-transparent border-l-2 relative hover:border-teal-100">
                                    <div class="w-6 flex flex-col items-center">
                                        <div
                                            class="flex justify-center items-center w-5 h-5 bg-red_custom-light rounded-full ">
                                            {{ $permission->id }}</div>
                                    </div>
                                    <div class="w-full ">
                                        <div class="mx-2 -mt-1 block w-full">{{ $permission->name }}
                                            <div class="w-full flex justify-center items-end">
                                                <div
                                                    class="text-xs truncate w-full normal-case font-normal -mt-1 text-gray-500">
                                                    description de la permission ...</div>
                                                <div class="flex ">
                                                    <x-button
                                                        path="{{ route('permissions.edit', $permission->id) }} "
                                                        action='Éditer'
                                                        class="inline-block m-0 mb-1 font-medium bg-red_custom-light hover:bg-red_custom" />
                                                    <form
                                                        action="{{ route('permissions.destroy', $permission->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit"
                                                            class="py-1 px-4 mr-3 rounded shadow cursor-pointer inline-block m-0 mb-1 font-medium bg-red_custom hover:bg-red_custom-dark text-gray-800">Effacer</button>

                                                    </form>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    </div>
                </div>

            </div>




        </div>
    </div>





    </div>

</x-app-layout>
