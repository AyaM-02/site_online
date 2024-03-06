@extends('layouts.layout')

@section('body')
    <div class="flex flex-wrap justify-center mt-8">
        <table class="border-collapse border border-gray-400">
            <thead>
                <tr>
                    <th class="border border-gray-400 px-4 py-2">Name</th>
                    <th class="border border-gray-400 px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    @php
                        $isFriend = false;
                        $isSentRequest = false;
                    @endphp
                    @foreach ($Friends as $friend)
                        @if ($friend->user_sender_id === $user->id)
                            @php
                                $isFriend = true;
                                break;
                            @endphp
                        @endif
                    @endforeach

                    @foreach ($Friends as $friend)
                        @if ($friend->status === 'verzonden' && $friend->ontvanger_id === $user->id or $friend->status === 'accepted' && $friend->ontvanger_id === $user->id)
                            @php
                                $isSentRequest = true;
                                break;
                            @endphp
                        @endif
                    @endforeach


                    @if (!$isFriend && !$isSentRequest && $user->id !== Auth::id())
                        <tr>
                            <td class="border border-gray-400 px-4 py-2">{{ $user->name }}</td>
                            <td class="border border-gray-400 px-4 py-2">
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    <a href="{{ route('friends.addfriend', $user->id) }}">Send Request</a>
                                </button>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>

        <table class="border-collapse border border-gray-400">
            <thead>
                <tr>
                    <th class="border border-gray-400 px-6 py-4">Friends</th>
                    <th class="border border-gray-400 px-6 py-4">Status</th>
                    <th class="border border-gray-400 px-6 py-4">Actions</th>   
                </tr>
            </thead>
            <tbody>

                @if ($Friends !== null)
                        @foreach ($Friends as $friend)
                                <td>{{ $friend->receiver->name }}</td>
                                <td>{{ $friend->status }}</td>
                                @if ($friend->status !== 'accepted' && $friend->status == "gekregen" )
                                    <td>
                                        <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                            <a href="{{ route('friends.accept', ['id' => $friend->ontvanger_id]) }}">Accept</a>
                                        </button>
                                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                            <a href="{{ route('friends.decline', ['id' => $friend->ontvanger_id]) }}">Decline</a>
                                        </button>
                                    </td>
                                @elseif($friend->status == 'accepted')
                                    <td>
                                    <button class="-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                            <a href="{{ route('messages.index',['receiver'=>$friend->ontvanger_id])}}">message</a>
                                        </button>
                                    </td>
                                @else
                                    <td>
                                        <p>Loading...</p>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    @endif 
            </tbody>
        </table> 
    </div>
    <div class="container mx-auto">
        <div class="flex flex-wrap justify-center mt-8">
            @foreach ($games as $game)
                @if ($game->visibility == "friends")
                    @php
                        $displayGame = false;
                    @endphp
    
                    @foreach ($Friends as $friend) 
                        @if ($friend->status == 'accepted' && $friend->ontvanger_id == $game->user_id && $friend->user_sender_id == Auth::id())
                            @php
                                $displayGame = true;
                                break; // Exit the inner loop once we find an accepted friend
                            @endphp
                        @endif
                    @endforeach
    
                    @if ($displayGame)
                        <div class="game mx-4 mb-4">
                            <img src="{{ $game->logo_file_path }}" height="90" width="90" alt="Game Logo">
                            <h3>{{ $game->name }}</h3>
                            <button class="bg-blue-500 hover:bg-blue-700 text-grey font-bold py-2 px-4 rounded border border-black">
                                <a href="{{ $game->link }}">Speel nu</a>
                            </button>
                        </div>
                    @endif
                @endif
            @endforeach
        </div>
    </div>
    
        
    
    

@stop
 
