@extends('layouts.app-index')
      
@section('navbar')
    <x-navbar-sub  :categoriesParent="$categoriesParent"/>
@endsection

@section('content')
    <main class="container mx-auto px-12 md:px-20 h-min-full mt-36 md:mt-44">
      
        @include('layouts/ad_banner')

        @include('layouts/garantie_banner')
        <!--liste categories-->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 my-4">
            @foreach ($categoriesParent as $category)
                <a href="{{ route('categories.categoriesChild', $category->id) }}"
                    class="relative z-30 hover:z-0 text-white">
                    <img class="w-full md:h-52 h-44 bg-white" src="{{ asset('img/charte/BODY/' . $category->picture) }}" alt="">
                    <span
                        class="absolute top-0 left-0 text-md tracking-tight font-medium leading-7 font-regular text-red-900 hover:underline">{{ $category->name }}
                    </span>
                </a>

            @endforeach
        </div>

        <!--liste partenaires-->
        <div class="grid grid-cols-1 lg:grid-cols-2 my-4">
            <div class="col-1">
                <h1>Top Ventes</h1>
                <p id="paraph">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quos, nobis enim accusantium
                    voluptatem exercitationem quaerat quidem
                    est debitis! Minima earum quod est pariatur, ipsum delectus aut blanditiis dolore doloribus sapiente.
                </p>
            </div>
            <div class="col-1">
                <h1>Nos partenaires</h1>
                <img class="w-full h-full bg-white" src="{{ asset('img/charte/BODY/partenaires_4_logos.png') }}"
                    alt="Partenaires">
            </div>

        </div>
        
    </main>
@endsection

@section('js_footer')
<script>
    function confirmDelete(id){
    let url = "{{ route('customers.show', ':id') }}";
    id = document.getElementById('customersName').value;
    url = url.replace(':id', id);
    document.location.href=url;
    }
</script>

@endsection