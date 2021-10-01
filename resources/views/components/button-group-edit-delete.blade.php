  <!------buttons------>
  <div class="flex absolute right-0 top-2">
    <a href="{{$path}}" type="submit" class="h-8 font-semibold py-1 px-2 mr-1 rounded shadow cursor-pointer inline-block m-0 mb-1 font-medium bg-red_custom-light hover:bg-red_custom" >{{$action}}</a>
    <form {{$route}} method="post">
        @csrf
        @method('delete')
        <button type="submit"
            class="h-8 font-semibold py-1 px-4 mr-1 rounded shadow cursor-pointer inline-block m-0 mb-1 font-medium bg-red_custom hover:bg-red_custom-dark text-gray-800">{{$action2}}</button>

    </form>

  </div>