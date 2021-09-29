@foreach ($categories as $c)
<p>{{$c->name}}</p>


@foreach ($c->products as $item)
    <p style="margin-left: 10px;">{{$item->label}}</p>
@endforeach
@endforeach