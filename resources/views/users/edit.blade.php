<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modification de l\'utilisateur ' . $user->username) }}
        </h2>
    </x-slot>
    <div class="bg-white mt-10 py-10 sm:py-16 lg:py-24">
        <div class="max-w-screen-2xl px-4 md:px-8 mx-auto">

            <!-- form - start -->
            <form method="post" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data"
                class="max-w-screen-md grid sm:grid-cols-2 gap-4 mx-auto">
                @csrf
                @method('PATCH')

                <!----Username---->
                <div>
                    <label for="username" class="inline-block text-gray-800 text-sm sm:text-base mb-2">Pseudo</label>
                    <input name="username" id="username" type="text" value="{{ $user->username }}"
                        placeholder="{{-- $user->username --}}"
                        class="w-full bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2 placeholder-gray-300" />

                    @error('username')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!----firstname---->
                <div>
                    <label for="firstname" class="inline-block text-gray-800 text-sm sm:text-base mb-2">Prénom</label>
                    <input name="firstname" id="firstname" type="text" value="{{ $user->firstname }}"
                        placeholder="{{-- $user->firstname --}}"
                        class="w-full bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2 placeholder-gray-300" />

                    @error('firstname')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!----lastname---->
                <div class="block">
                    <label for="lastname" class="inline-block text-gray-800 text-sm sm:text-base mb-2">Nom</label>
                    <input name="lastname" id="lastname" type="text" value="{{ $user->lastname }}"
                        placeholder="{{-- $user->lastname --}}"
                        class="w-full bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2 placeholder-gray-300" />

                    @error('lastname')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!----role---->
                <div class="block">
                    <span class="text-gray-700">Roles</span>
                    <div class="mt-2">
                        {{-- @foreach ($user->roles as $role) --}}
                        <div>
                            <label for="role{{-- role->id --}}"
                                class="inline-flex text-gray-800 text-sm sm:text-base mb-2">
                                <input type="checkbox" name="role{{-- role->id --}}" id="role" class="form-checkbox"
                                    checked>
                                <span class="ml-2">{{-- $user->role --}}opt1</span>
                            </label>
                            @error('role')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                            <label for="role{{-- role->id --}}"
                                class="inline-flex text-gray-800 text-sm sm:text-base mb-2">
                                <input type="checkbox" name="role{{-- role->id --}}" id="role" class="form-checkbox"
                                    checked>
                                <span class="ml-2">{{-- $user->role --}}opt2</span>
                            </label>
                            @error('role')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                            <label for="role{{-- role->id --}}"
                                class="inline-flex text-gray-800 text-sm sm:text-base mb-2">
                                <input type="checkbox" name="role{{-- role->id --}}" id="role" class="form-checkbox"
                                    checked>
                                <span class="ml-2">{{-- $user->role --}}opt3</span>
                            </label>
                            @error('role')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                            <label for="role{{-- role->id --}}"
                                class="inline-flex text-gray-800 text-sm sm:text-base mb-2">
                                <input type="checkbox" name="role{{-- role->id --}}" id="role" class="form-checkbox"
                                    checked>
                                <span class="ml-2">{{-- $user->role --}}opt4</span>
                            </label>
                            @error('role')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        {{-- @endforeach --}}
                    </div>
                </div>
                
                <!----permission---->
                <div class="block">
                    <span class="text-gray-700">Permissions</span>
                    <div class="mt-2">
                        {{-- @foreach ($user->permissions as $permission) --}}
                        <div>
                            <label for="permission{{-- permission->id --}}"
                                class="inline-flex text-gray-800 text-sm sm:text-base mb-2">
                                <input type="checkbox" name="permission{{-- permission->id --}}" id="permission" class="form-checkbox"
                                    checked>
                                <span class="ml-2">{{-- $user->permission --}}opt1</span>
                            </label>
                            @error('permission')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror

                            <label for="permission{{-- permission->id --}}"
                                class="inline-flex text-gray-800 text-sm sm:text-base mb-2">
                                <input type="checkbox" name="permission{{-- permission->id --}}" id="permission" class="form-checkbox"
                                    checked>
                                <span class="ml-2">{{-- $user->permission --}}opt2</span>
                            </label>
                            @error('permission')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        {{-- @endforeach --}}
                    </div>
                </div>

                <!----submit---->
                <div class="sm:col-span-2 flex justify-between items-center">
                    <button type="submit"
                        class="font-semibold py-1 px-4 mr-3 rounded shadow cursor-pointer inline-block m-0 mb-1 bg-red_custom-light hover:bg-red_custom">Éditer</button>
                    <!----required---->
                    <span class="text-gray-500 text-sm">*Champs requis</span>
                </div>

            </form>
            <!-- form - end -->
        </div>
    </div>

</x-app-layout>
