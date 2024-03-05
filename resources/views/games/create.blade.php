@extends('layouts.layout')
@section('body')
{{-- //als je een game create word je gestuurd dan zorgt ervoor dat de route de ingevulde data naar de database gaat --}}
  <form action="{{ route('games.data') }}" method="post" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 w-1/2">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                Game Naam
            </label>
            <input class="shadow appearance-none border rounded-full w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" placeholder="Game Naam" name="name">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="logo_file_path">
                Logo
            </label>
            <input class="shadow appearance-none border rounded-full w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="logo_file_path" type="file" name="logo_file_path">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="link">
                Game Link
            </label>
            <input class="shadow appearance-none border rounded-full w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="link" type="text" placeholder="Game Link" name="link">
        </div>
        <div>
            <label for="visibility">Zichtbaarheid</label>
            <select name="visibility" id="visibility">
                <option value="public">Public</option>
                <option value="private">Privé</option>
                <option value="friends">Friends</option>
            </select>
        </div>
        <div class="mb-4">
            <button class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded-full focus:outline-none focus:shadow-outline" type="submit">
                Create Game
            </button>
        </div>
    </form>
@stop
