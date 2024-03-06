@extends('layouts.layout')

@section('body')
    <div class="flex flex-wrap justify-center mt-8">

        @guest
            <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-700 text-black py-2 px-4 rounded">Create game</a>
        @else
            <a href="{{ route('games.create') }}" class="bg-blue-500 hover:bg-blue-700 text-black py-2 px-4 rounded">Create
                game</a>
        @endguest

        <div class="w-full mt-8">
            <h3 class="text-xl font-semibold">Public Games</h3>
            <div class="flex flex-wrap justify-between">
                @foreach ($games as $game)
                    @if ($game->visibility == 'public')
                        <div class="m-4">
                            <div class="box-content h-56 w-40 p-4 border border-purple-500 shadow-md">
                                <div class="py-8">
                                    <img src="{{ $game->logo_file_path }}" alt="game" width="90" height="90">
                                </div>
                                <div class="py-4">
                                    <h2 class="text-lg font-semibold">Game Name: {{ $game->name }}</h2>
                                </div>
                                <div class="pt-3">
                                    @auth
                                    
                                        @if (auth()->user()->id === $game->user_id)
                                            <form action="{{ route('games.delete', $game->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit"
                                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Delete</button>
                                            </form>
                                            <button
                                                class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-1 px-2 border border-blue-500 hover:border-transparent rounded">
                                                <a href="{{ route('games.edit', $game->id) }}">Edit game</a>
                                            </button>
                                        @endif
                                    @endauth
                                    @guest
                                        <a href="{{ route('login') }}"
                                            class="bg-blue-500 hover:bg-blue-700 text-black py-2 px-4 rounded">Go to game</a>
                                    @else
                                        <a href="{{ $game->link }}"
                                            class="bg-blue-500 hover:bg-blue-700 text-black py-2 px-4 rounded">Go to game</a>
                                    @endguest

                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        @auth
            <div class="w-full mt-8">
                <h3 class="text-xl font-semibold mb-2">Private Games</h3>
                <div class="flex flex-wrap justify-between">
                    @foreach ($games as $game)
                        @if ($game->visibility == 'private' and auth()->user()->id == $game->user_id)
                            <div class="m-4">
                                <div class="box-content h-56 w-40 p-4 border border-purple-500 shadow-md">
                                    <div class="py-8">
                                        <img src="{{ $game->logo_file_path }}" alt="game" width="90" height="90">
                                    </div>
                                    <div class="py-4">
                                        <h2 class="text-lg font-semibold">Game Name: {{ $game->name }}</h2>
                                    </div>
                                    <div class="pt-3">
                                        <form action="{{ route('games.delete', $game->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit"
                                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Delete</button>
                                        </form>
                                        <button
                                            class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-1 px-2 border border-blue-500 hover:border-transparent rounded">
                                            <a href="{{ route('games.edit', $game->id) }}">Edit game</a>
                                        </button>
                                        <button
                                            class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-1 px-2 border border-blue-500 hover:border-transparent rounded">
                                            <a href="{{ $game->link }}">Go to game</a>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endauth
    </div>
@stop
