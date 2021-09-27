@foreach ($products as $product)
<p>{{ $product->label }}</p>
<p>{{ $product->EAN }}</p>
<img width="30" height="30" src="{{Storage::url('pictures/'. $product->picture)}}" alt="">
<p>{{ $product->picture }}</p>
@endforeach
