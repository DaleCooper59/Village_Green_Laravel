<div id="nav_categories"
        class="relative flex items-center justify-end mx-auto w-full h-20 my-0 bg-gray-700 text-white font-semibold text-sm sm:pt-0">


        @foreach ($categoriesParent as $category)
            <div x-data="{ open: false }" class="relative">
                <button @click="open = true" class="font-semibold py-1 mx-2 inline-block">{{ $category->name }}</button>
                @if (count($category->children))
                    <ul x-show="open" @click.away="open = false"
                        x-transition:enter="transition ease-out origin-top-left duration-200"
                        x-transition:enter-start="opacity-0 transform scale-90"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition origin-top-left ease-in duration-100"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-90"
                        class="absolute z-30 shadow-sm p-5 rounded mt-2 bg-gray-100">

                        @foreach ($category->children as $item)
                            <li class=" border-b-2 border-gray-300 py-1 text-black">
                                <a href="{{ route('categories.show', $item->id) }}">{{ $item->name }}</a>
                            </li>
                        @endforeach


                    </ul>
                @endif
            </div>
           
        @endforeach
 <a href="{{ route('categories.index') }}" class="font-semibold py-1 mx-2 inline-block">Tous</a>
    </div>