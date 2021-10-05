<div {{$attributes->merge(['class' => 'font-semibold py-1 px-4 mr-3 rounded shadow cursor-pointer'])}}>
    <a class="{{$p}}" href="{{$path}}" type="submit">{{$action}} <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute top-0 left-2 h-full" viewBox="0 0 20 20" fill="currentColor"><path d="{{$svg}}"/></svg></a>
</div>