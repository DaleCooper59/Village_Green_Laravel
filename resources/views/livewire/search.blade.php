<div>
    <label for="city" class="inline-block text-gray-800 text-sm sm:text-base mb-2">Ville</label>
    <input type="text" wire:model="searchTerm" name="city" id="city"
    class="py-2 text-sm bg-gray-50 rounded-md pl-10 focus:outline-none focus:bg-white focus:text-gray-900"
    placeholder="Search..." autocomplete="off" />

    @foreach ($cities as $city)
        <p>{{$city->name}}</p>
    @endforeach
  
    @error('city')
        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
    @enderror
</div>