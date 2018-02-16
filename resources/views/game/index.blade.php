@extends('layouts.master')

@section('content')

@if($game['canceled'])
<div class="alert alert-danger" role="alert">
  <h5 class="mb-0">This game has been canceled</h5>
  
  @if($game['note'] !== NULL)
  <hr>
  <p class="mb-0">{{ $game['note'] }}</p>
  @endif

</div>
@endif

@include('game.weather')

@include('game.info_header')
@include('game.info')

@include('game.attendance')

@include('game.settings')

@endsection