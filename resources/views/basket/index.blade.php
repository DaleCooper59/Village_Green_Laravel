@extends('layouts.app-index')


@section('navbar')
    <x-navbar-sub :categoriesParent="$categoriesParent" />
@endsection

@section('content')


@livewire('cart-content')

@endsection

@section('js_footer')
    <script>
        let quantity = document.getElementById('quantity');

        function updateQty(qty) {
            quantity.addEventListener('change', function() {
                return qty = this.value;
            });
        }
    </script>
@endsection