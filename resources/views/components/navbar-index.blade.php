<div>
    <nav id="header" class="fixed bg-gray-300 w-full lg:w-3/4 h-20 z-40 top-10">
        <div id="progress" class="h-1 z-40 top-10"
            style="background:linear-gradient(to right, #D08591 var(--scroll), transparent 0);"></div>
        <div class="w-full mx-auto flex flex-wrap items-center justify-between h-20 mt-0 ">
            <div class="block lg:absolute z-40 pl-8 lg:pl-0 p-2">
               <a href="{{ route('index') }}"><img id="logo" class="xl:block hidden" src="{{ asset('img/logo_village_green.png') }}" alt="Logo"></a> 
                <a class="xl:hidden block ml-3 text-2xl italic font-bold no-underline" href="{{ route('index') }}">
                Village Green
                </a>
            </div>
            <div class="block lg:hidden pr-4">
                <button id="nav-toggle" class="flex items-center px-3 py-2 text-red-400 border-gray-600 focus:outline-none">
              <svg fill="text-red-400" viewBox="0 0 20 20" class="w-6 h-6 fill-current">
                <title>Menu</title>
                <path fill-rule="evenodd"
                  d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z"
                  clip-rule="evenodd"></path>
              </svg>
            </button>
            </div>
            <div class="w-full flex-grow p-4 lg:flex lg:items-center hidden mt-2 lg:mt-0 bg-gray-300 z-20"
                id="nav-content">
                <ul class="list-reset lg:flex justify-end flex-1 items-center">
                    <li class="mr-3">
                        <a class="border-b-0 md:border-b-4 border-red-500 inline-block py-2 px-4 text-red-400 font-bold"
                            href="{{route('products.allProducts')}}">Produits</a>
                    </li>
                    <li class="mr-3">
                        <a class="inline-block hover:text-red-400 hover:text-underline py-2 px-4" href="#">Service</a>
                    </li>
                    <li class="mr-3">
                        <a class="inline-block hover:text-red-400 hover:text-underline py-2 px-4" href="#">Aide</a>
                    </li>
                    <li class="mr-3">
                        <a class="inline-block hover:text-red-400 hover:text-underline py-2 px-4" href="#">À propos</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    

</div>