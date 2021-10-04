<div >
    <label for="{{$label}}" class="inline-block text-gray-800 text-sm sm:text-base mb-2">{{$title}}</label>
    <input name="{{$label}}" id="{{$label}}" type="{{$type}}" value="{{ $value }}"
        placeholder="{{$placeholder}}"
        class="w-full bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2 placeholder-gray-300" />
   
    @error('{{$label}}')
        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
    @enderror
</div>