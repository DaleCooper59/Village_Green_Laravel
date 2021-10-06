<div class="flex justify-end">
<ul class="absolute z-10 top-0 flex items-center justify-end w-full lg:w-3/4 mx-auto h-10 bg-gradient-to-r from-gray-100 via-white to-white sm:items-center sm:pt-0">
    <!---------------------Connexion-------------->
    @if (Route::has('login'))
       
        @auth
            <li>
                <x-button path="{{ url('/dashboard') }}" action='Dashboard'
                    class=" h-7 hover:bg-gray-400 text-gray-800 " />
            </li>
          
           <li><!----------------------MODAL---------------------->
               <x-modal/>
               @if(count(Auth::user()->customers))
                 <x-button path="{{ route('customers.show', Auth::user()->id) }}" action='Espace Client'
                    class=" h-7 bg-red_custom hover:bg-white text-gray-800" />
               @elseif(Auth::user()->roles[0]['name'] === 'god' || Auth::user()->roles[0]['name'] === 'admin')
              {{-- <form id="formCustomerControl">
                    <select name="customersName" id="customersName">
                        @foreach ($customers as $customer)
                            <option value="{{$customer->id}}">{{$customer->name}}</option>
                        @endforeach
                    </select>
                    <button onclick="confirmDelete(id)" type="submit">Voir fiche client ?</button>
               </form>--}}
              
                @else
                 <span></span>
                @endif
                   
            </li>
             @else      
            <li>
                <x-button path="{{ route('login') }}" action='Se connecter'
                    class=" h-7 bg-green-200 hover:bg-gray-400 text-gray-800" />
            </li>

            @if (Route::has('register'))
                <li>
                    <x-button path="{{ route('register') }}" action='Créer un compte'
                        class=" h-7  hover:bg-gray-400 text-gray-800" />
                </li>
            @endif
        @endauth  
        <a href="#" class="font-semibold py-1 px-4 mr-3"><img src="{{asset('img/picto_panier.png')}}" alt="panier"></a>
        <a href="{{ route('login') }}" class="font-semibold py-1 px-4 mr-3"><img src="{{asset('img/picto_pays.png')}}" alt="panier"></a>
       
        
    @endif
</ul>
</div>
