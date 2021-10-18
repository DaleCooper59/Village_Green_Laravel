<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panneau d\'administration') }}
        </h2>
        <div class="flex mt-3">
            <x-button path="{{ route('products.create') }}" action='Ajouter un produit'
                class="bg-gray-200 w-auto inline-block hover:bg-gray-400 text-gray-800 border-gray-400">
                <x-slot name="icon"> <i class="fas fa-home"></i>
                </x-slot>
            </x-button>
            <x-button path="{{ route('categories.create') }}" action='Ajouter une catégorie'
                class="bg-gray-200 w-auto inline-block hover:bg-gray-400 text-gray-800 border-gray-400" />
        </div>

        <x-stat-card />
    </x-slot>

    <h3 class="text-md font italic text-gray-400">*En fonction de vos paramètres vous pourrez accomplir les actions
        autorisées, demandez à l'administrateur pour plus de fonctionnalités</h3>


    <div class="divide-y divide-gray-200 mt-10">
        <h3 class="text-4xl font-normal text-center leading-normal mt-0 mb-2 text-gray-400">
           Liste des tâches
          </h3>
        <!--------------------Liste des tâches ----------------->
        <div class="flex flex-col w-full xl:-mx-4 my-4">
            <div class="overflow-x-auto mx-auto">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">

                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tâche
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Détail de la tâche
                                    </th>

                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider flex flex-col">
                                        Status
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Employés concernés
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Que faire ?
                                    </th>

                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($todos as $todo)

                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $todo->title }}
                                        </td>
                                        <td class="px-2 py-4 whitespace-nowrap">
                                            {{ $todo->detail }}

                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            @if ($todo->state === 0)
                                                <span>Non fait</span>
                                            @else
                                                <span>fait</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <ul>
                                                @foreach ($todo->employees as $employeeWithTodo)
                                                    <li>{{ $employeeWithTodo->user->firstname . ' ' . $employeeWithTodo->user->lastname }}
                                                    </li>
                                                @endforeach
                                            </ul>


                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <x-button-group-edit-delete path="{{-- route('todos.edit', $todo->id) --}}" action="Éditer"
                                                route="{{-- route('todos.destroy', ['todo' => $todo->id]) --}}" action2="Effacer" />
                                        </td>
                                    </tr>
                                @endforeach
                                <!-- More people... -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--------------------Fin de Liste des tâches ----------------->

        <h3 class="text-4xl font-normal text-center leading-normal mt-0 mb-2 text-gray-400">
            Roles, permissions, ...
           </h3>

        <div class="flex flex-wrap justify-center overflow-hidden my-4">

            <!------dropdown----->
            <!------first-drop----->
            <div class="w-full overflow-hidden xl:my-4 xl:px-4 xl:w-1/2">

                <div class=" bg-white max-w-xl mx-auto border border-gray-200" x-data="{selected:null}">

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

                        <div class="relative overflow-hidden transition-all max-h-0 duration-700" style=""
                            x-ref="container1"
                            x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">
                            <div class="p-6">
                                @foreach ($roles as $role)
                                    <div
                                        class="cursor-pointer w-full border-gray-100 rounded-t border-b hover:bg-teal-100">
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
                <!------second-drop----->

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

                        <div class="relative overflow-hidden transition-all max-h-0 duration-700" style=""
                            x-ref="container1"
                            x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">
                            <div class="p-6">
                                @foreach ($permissions as $permission)
                                    <div
                                        class="cursor-pointer w-full border-gray-100 rounded-t border-b hover:bg-teal-100">
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
            <!------end-dropdown----->


            <div class="w-full overflow-hidden xl:my-4 xl:px-4 xl:w-1/2">

            </div>

        </div>
        <h3 class="text-4xl font-normal text-center leading-normal mt-0 mb-2 text-gray-400">
            Liste des tâches
           </h3>
    </div>











</x-app-layout>
