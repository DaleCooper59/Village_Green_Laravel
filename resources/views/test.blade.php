@extends('layouts.app-index')

@section('content')
    <div class="bg-white mt-10 py-10 sm:py-16 lg:py-24">
        <div class="max-w-screen-2xl px-4 md:px-8 mx-auto">

            <x-form method='post' route="{{ route('users.update', 2) }}" action="Éditer">
                @csrf
                @method('PATCH')

                <x-input label="username" title="Pseudo d'utilisateur" type="text" value=" blabla " placeholder='some' />
                <x-input label="firstname" title="Prénom" type="text" value=" blab " placeholder='some' />
                <x-input label="Nom" title="Nom" type="text" value=" bla" placeholder='some' />
                <x-input label="username" title="Nom d'utilisateur" type="text" value=" blabla " placeholder='some' />
            </x-form>
        </div>
    </div>


    
@endsection
