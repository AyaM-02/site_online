@extends('layouts.layout')

@section('body')
<div class="container mx-auto" >
    <h3>achievements</h3>
    @foreach( $achievements as $achievement )
    {{$achievement->title}}
    <img src="{{$achievement->picture_url}}" width="120" height="120">
    @endforeach
</div>
@stop
