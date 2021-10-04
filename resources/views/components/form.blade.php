<!-- form - start -->
<form method="{{ $method }}" action="{{ $route }}"
    class="max-w-screen-md grid sm:grid-cols-2 gap-4 mx-auto">


    {{ $slot }}

    <!----submit---->
    <div class="sm:col-span-2 flex justify-between items-center">
        <button type="submit"
            class="font-semibold py-1 px-4 mr-3 rounded shadow cursor-pointer inline-block m-0 mb-1 bg-red_custom-light hover:bg-red_custom">{{ $action }}</button>
        <!----required---->
        <span class="text-gray-500 text-sm">*Champs requis</span>
    </div>

</form>
<!-- form - end -->
