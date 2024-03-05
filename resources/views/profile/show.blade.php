@extends('layouts.layout')

@section('body')
<div class="container mx-auto">
    <div class="flex flex-wrap justify-center mt-8">
        <div class="grid grid-cols-2 gap-4">
            @foreach ($users as $user)
            <div class="bg-gray-200 p-4 rounded-lg">
                <h2 class="text-xl font-semibold mb-2"> Naam: {{ $user->name }}</h2>
                <img src="{{ asset($user->profile_image) }}" alt="foto" class="rounded-lg mb-2" width="90" height="90">
                <div class="inline-block border border-gray-400 rounded px-4 py-2">
                    <a href="{{route('profile.edit')}}" class="inline-block bg-white text-gray-800">edit</a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="grid grid-cols-2 gap-4">
            @foreach($games as $game)
            <div class="bg-gray-200 p-4 rounded-lg">
                <h2 class="text-xl font-semibold mb-2">Game naam: {{ $game->name }}</h2>
                    <img src="{{ asset($game->logo_file_path) }}" alt="foto" class="rounded-lg mb-2" width="90" height="90">
                <!-- Voeg hier andere informatie toe over het spel -->
            </div>
            @endforeach
        </div>
    </div>
</div>
@stop
