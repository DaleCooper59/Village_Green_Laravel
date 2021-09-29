@extends('layouts.app-index')

@section('content')
<div class="w-full h-screen mt-72">
     <p>{{ $products->label }}</p>
<p>{{ $products->EAN }}</p>
<img width="30" height="30" src="{{Storage::url( $products->picture)}}" alt="">
<p>{{ $products->picture }}</p>

</div>

    
@endsection

