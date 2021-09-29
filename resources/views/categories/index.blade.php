//toutes les produits
@foreach ($products as $item)
    <p style="margin-left: 50px;">{{$item->label}}</p>
@endforeach


//toutes les categories parentes
@foreach ($categories as $c)
<p style="margin-left: 50px;">{{$c->name}}</p>

@endforeach


//toutes les sous categories
@foreach ($categoriesChild as $item)
    <p style="margin-left: 50px;">{{$item->name}}</p>
@endforeach