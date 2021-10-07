<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Les utilisateurs') }}
        </h2>
    </x-slot>

    <div class="flex flex-col">
        <div class="overflow-x-auto container mx-auto">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nom d'utilisateur
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Identité
                                </th>

                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider flex flex-col">
                                    Type
                                    <span class="text-xs italic lowercase">*ni vendeur ni client</span>
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Role
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Permission
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>

                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($users as $user)

                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                       @if (count($user->customers))
                                           <a href="{{route('customers.show', $user->customers[0]['id'])}}" title="Voir la fiche client"> 
                                            <div class="text-sm text-gray-900">Id : {{ $user->id }}</div>
                                        <div class="text-sm text-gray-500">Pseudo : {{ $user->username }}</div>
                                        </a>
                                        @else
                                        <div class="text-sm text-gray-900">Id : {{ $user->id }}</div>
                                        <div class="text-sm text-gray-500">Pseudo : {{ $user->username }}</div>
                                       @endif 
                                       
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                @if ($user->profile_photo_path === null)
                                                    <img class="h-10 w-10 rounded-full"
                                                        src="https://i.pravatar.cc/100?u={{ $user->id }}" alt="">
                                                @else
                                                    <img class="h-10 w-10 rounded-full"
                                                        src="{{ Storage::url($user->profile_photo_path) }}"
                                                        alt="">

                                                @endif

                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $user->firstname }} {{ $user->lastname }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{ $user->email }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">

                                        @if (count($user->customers))
                                            <div class="text-sm text-gray-900">n° de client:
                                                {{ ' ' . $user->customers[0]['id'] . ', ' . ucFirst($user->customers[0]['type']) }}
                                            </div>
                                        @elseif(count($user->employees))
                                            <div class="text-sm text-gray-900">n° d'employé:
                                                {{ ' ' . $user->employees[0]['id'] . ', Vendeur ' . ucFirst($user->employees[0]['department']) }}
                                            </div>
                                        @else
                                            <div class="text-sm text-gray-900">Autre*</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @foreach ($user->roles as $role)
                                            <a href="#"
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                {{ $role->name }}
                                            </a>
                                        @endforeach

                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        @foreach ($user->getAllPermissions() as $permission)
                                            <a href="#"
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                {{ $permission->name }}
                                            </a>
                                        @endforeach

                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <x-button-group-edit-delete path="{{ route('users.edit', $user->id) }}"
                                            action="Éditer"
                                            route="{{ route('users.destroy', ['user' => $user->id]) }}"
                                            action2="Effacer" />
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


</x-app-layout>
