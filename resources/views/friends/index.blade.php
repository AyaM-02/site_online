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
                    {{-- Check if $user is already a friend --}}
                    @foreach ($Friends as $friend)
                    {{-- // is de sender(van friends) gelijk aan de (user van de users)  --}}
                        @if ($friend->user_sender_id === $user->id)
                            @php
                                $isFriend = true;
                                break;
                            @endphp
                        @endif
                    @endforeach

                    {{-- Check if friend request is already sent --}}
                    @foreach ($Friends as $friend)
                        @if ($friend->status === 'verzonden' && $friend->ontvanger_id === $user->id or $friend->status === 'accepted' && $friend->ontvanger_id === $user->id)
                            @php
                                $isSentRequest = true;
                                break;
                            @endphp
                        @endif
                    @endforeach

                    {{-- Display the user if not a friend and friend request not sent --}}

                    @if (!$isFriend && !$isSentRequest && $user->id !== Auth::id())
                    {{-- // isfriendNot en isSentRequestNot , je kan niet jezelf een vriendschap verzoek sturen  --}}
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

                {{-- Friend list --}}
                {{-- als er een friend is, not null -> is niet leeg, er is iets van data --}}
                @if ($Friends !== null)
                        @foreach ($Friends as $friend)
                            {{-- <tr>    // de naam laten zien naar wie je hebt gestuurd  --}}
                                <td>{{ $friend->receiver->name }}</td>
                                {{-- // laat zien de status van "verzonden, accepted" --}}
                                <td>{{ $friend->status }}</td>
                                @if ($friend->status !== 'accepted' && $friend->status == "gekregen" )
                                {{-- als da ni geaccpteerd is dan dan kan je da accpeteren en decline en de status moet gekregen zijn zodat allen de persoon die dat gekregen heeft kan accpeteren en decline --}}
                                    <td>
                                        <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                            // de id verwijst naar welke id de ontvanger
                                            <a href="{{ route('friends.accept', ['id' => $friend->ontvanger_id]) }}">Accept</a>
                                        </button>
                                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                            <a href="{{ route('friends.decline', ['id' => $friend->ontvanger_id]) }}">Decline</a>
                                        </button>
                                    </td>
                                @elseif($friend->status == 'accepted')
                                    <td>
                                        {{-- //als het accpeted is kan je ook een message sturen naar diegene die dat heeft geaccepteerd, die pijltje betekent dat je de waarde geeft aan de parameter  --}}
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
    {{-- het gerbuik van php is van belang om geen dubbele data te laten zien  --}}
    <div class="container mx-auto">
        <div class="flex flex-wrap justify-center mt-8">
            @foreach ($games as $game)
            {{-- // eerst zien of de game visivilit is friend, als da friend is zet je dat op false  --}}
                @if ($game->visibility == "friends")
                    @php
                        $displayGame = false;
                    @endphp
    
                    @foreach ($Friends as $friend) 
                    {{-- friend-> ontvangerid betekent dat je naar de ontvanger id moet kijken bij friend en dan kijk naar in de game naar userId en die moeten gelijk zijn anders kan je niet zien van wie de game is   --}}
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
 