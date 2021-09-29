<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-buttonConnexion path="{{ route('index') }}" action='Village Green' class="bg-white hover:bg-gray-400 text-gray-800 border-gray-400" />
    <x-buttonConnexion path="{{ route('products.create') }}" action='Ajouter un produit' class="bg-white hover:bg-gray-400 text-gray-800 border-gray-400" />
</x-app-layout>
