@extends('layouts.layout')

@section('body')
    <div class="flex flex-wrap justify-center mt-8">
        <div class="max-w-md mx-auto">
            {{-- //eerst kom je in de form index.blade en dan als je een berocht stuurt word je doorverwezn naar de route  --}}
            <form action="{{ route('messages.sendbericht', $receiver) }}" method="POST"
                class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                @csrf
                <textarea rows="10" cols="5" placeholder="bericht" name="bericht"
                    class="shadow appearance-none border rounded w-full py-2 px-3 mb-4"></textarea>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">Send
                    bericht</button>
            </form>
        </div>
        <div class="max-w-md mx-auto">
            <h2 class="text-xl mb-2">verzonden-berichten</h2>
            @foreach ($verzondenBerichten as $bericht)
                <div class="bg-gray-200 rounded p-3 mb-2">
                    <div>
                        <p>Sender: {{ $bericht->sender->name }}</p>
                        <p>bericht: {{ $bericht->text }}</p>
                        <p class="mb-10">Receiver: {{ $bericht->receiver->name }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="max-w-md mx-auto">
            <h2 class="text-xl mb-2">ontvangen-berichten</h2>
            @foreach ($ontvangenBerichten as $bericht)
                <div class="bg-gray-200 rounded p-3 mb-2">
                    <div>
                        <p>Sender: {{ $bericht->sender->name }}</p>
                        <p>Bericht: {{ $bericht->text }}</p>
                        <p class="mb-10">Receiver: {{ $bericht->receiver->name }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@stop
