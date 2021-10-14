<div class="my-10">

    <input wire:model.debounce.500="searchCountries" wire:keydown.tab='clear' name="countries" id="countries"
        type="text" placeholder="Pays..." class=" py-2 border-0 border-b-2 border-green-600 focus:outline-red-600">

    <div wire:loading wire:target="searchCountries">
        <div class=" flex justify-center items-center">
            <div class="animate-spin rounded-full h-6 w-6 border-t-2 border-b-2 border-green-500"></div>
        </div>

    </div>

    @if (!empty($searchCountries))
        @if (!empty($countries))
            <select class="py-2 border-0 border-b-2 border-green-600 focus:outline-green-600" name="countries"
                id="select_country">
                <option value="">--choisissez un pays--</option>

                @forelse ($countries as $k => $country)
                    <option value="{{ $country->id }}">
                        {{ $country->name }}</option>

                @empty
                    <option>Aucun pays ne correspond ...</option>
                @endforelse


            </select>

        @endif

    @endif

    
</div>
