<h1>{{$category->name}}</h1>

<ul>
    @foreach ($products as $product)
        <li>{{$product->label}}</li>
    @endforeach
</ul>