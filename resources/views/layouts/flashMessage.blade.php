<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if (session()->has($msg))
            <div x-data="{show:true}" x-init="setTimeout(()=>show = false, 5000)" x-show="show">

                @if ($msg === 'success')
                    rounded-lg p-4 mb-4 text-sm
                    <button
                        class="fixed z-50 bottom-0 right-0 {{ $msg }} text-green-700 bg-green-100 hover:bg-green-300 hover:text-white border border-dash shadow-lg  font-bold text-sm px-4 py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                        type="button">
                    @elseif($msg === 'danger')
                        <button
                            class="fixed z-50 bottom-0 right-0 {{ $msg }} text-red-700 bg-red-100 hover:bg-red-300 hover:text-white border border-dash shadow-lg  font-bold text-sm px-4 py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                            type="button">
                        @elseif($msg === 'info')
                            <button
                                class="fixed z-50 bottom-0 right-0 {{ $msg }} text-indigo-700 bg-indigo-100 hover:bg-indigo-300 hover:text-white border border-dash shadow-lg  font-bold text-sm px-4 py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                type="button">
                            @else
                                <button
                                    class="fixed z-50 bottom-0 right-0 {{ $msg }} text-yellow-700 bg-yellow-100 hover:bg-yellow-300 hover:text-white border border-dash shadow-lg  font-bold text-sm px-4 py-2 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                                    type="button">
                @endif

                {{ session()->get($msg) }}
                </button>
            </div>
        @endif
    @endforeach
</div>
