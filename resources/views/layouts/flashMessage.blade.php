<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if (session()->has($msg))
            <div x-data="{show:true}" 
                    x-init="setTimeout(()=>show = false, 5000)"
                    x-show="show">
                
                @if($msg === 'success')
                <button
                    class="fixed z-50 bottom-0 right-0 {{ $msg }} text-green-300 border-green-500 hover:bg-gray-300 hover:text-green-600 active:bg-gray-600  bg-gray-200 border border-solid   font-bold uppercase text-xs px-4 py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                    type="button">
                @elseif($msg === 'danger')
                <button
                class="fixed z-50 bottom-0 right-0 {{ $msg }} text-red-300 border-red-500 hover:bg-gray-300 hover:text-red-600 active:bg-gray-600' bg-gray-200 border border-solid   font-bold uppercase text-xs px-4 py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                type="button">
                @elseif($msg === 'info')
                <button
                class="fixed z-50 bottom-0 right-0 {{ $msg }} text-indigo-300 border-indigo-500 hover:bg-gray-300 hover:text-indigo-600 active:bg-gray-600' bg-gray-200 border border-solid   font-bold uppercase text-xs px-4 py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                type="button">
                     @else
                     <button
                     class="fixed z-50 bottom-0 right-0 {{ $msg }} text-yellow-300 border-yellow-500 hover:bg-gray-300 hover:text-yellow-600 active:bg-gray-600' bg-gray-200 border border-solid   font-bold uppercase text-xs px-4 py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                     type="button">
                @endif
                
                    {{ session()->get($msg) }}
                </button>
            </div>
        @endif
    @endforeach
</div>