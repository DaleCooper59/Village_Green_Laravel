<div class="relative">

    <!-- image - start -->
    <a href="{{ $path }}"
        {{ $attributes->merge(['class' => 'group h-48 md:h-80 flex items-end bg-gray-100 overflow-hidden rounded-lg shadow-lg relative']) }}>
        <img src="{{ $src }}" loading="lazy" alt="{{ $name }}"
            class="w-full h-full object-cover object-center absolute inset-0 transform group-hover:scale-110 transition duration-200">

       <!-- <div
            class="relative bg-gradient-to-t from-gray-800 via-transparent to-transparent opacity-50 inset-0 pointer-events-none">
        </div>-->

        <span
            class="inline-block bg-gray-white hover:shadow-md text-white text-sm md:text-lg relative bottom-1 rigth-1 ml-4 md:ml-5 mb-3">{{ $name }}</span>
        {{ $slot }}
    </a>
    <!-- image - end -->
</div>
