<div class="my-10">

    <input wire:model.debounce.500="search" wire:keydown.ArrowUp="decrementHighlight"
        wire:keydown.ArrowDown="incrementHighlight" wire:keydown.tab='clear' name="city" id="city" type="text"
        placeholder="Ville..." class="py-2 border-0 border-b-2 border-green-600 focus:outline-green-600">

    <div wire:loading wire:target="search">
        <div class=" flex justify-center items-center">
            <div class="animate-spin rounded-full h-6 w-6 border-t-2 border-b-2 border-green-500"></div>
        </div>

    </div>
    {{-- $cities->onEachSide(1)->links() --}}
    @if (!empty($search))
        @if (!empty($cities))
            <select class="py-2 border-0 border-b-2 border-green-600 focus:outline-green-600" name="cities" id="city_select">
                <option value="">--choisissez une ville--</option>

                @forelse ($cities as $k => $city)
                    <option value="{{ $city->id }}">
                        {{ $city->name . ' - ' . $city->postal_code }}</option>

                @empty
                    <option>Aucune ville ne correspond ...</option>
                @endforelse


            </select>

        @endif

    @endif

</div>
