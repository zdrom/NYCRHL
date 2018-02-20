@extends('layouts.master')

@section('content')

<div class="row justify-content-center">
	<div class="col-md-6">
		<h3 class="mb-0 text-white">Next @if(count($games) > 1)Games @else game @endif on:</h3>
	</div>
</div>
<div class="row justify-content-center">
	<div class="col-md-6">
		<h3 class="mb-0 text-white">{{ \Carbon\Carbon::parse($games[0]['date'] . 'EST')->format('l, F j')  }}</h3>
	</div>
</div>
<div class="row mb-4 justify-content-center">
	<div class="col-md-6">
		<h3 class="mb-0"><small class="text-muted">{{ \Carbon\Carbon::parse($games[0]['date'] . 'EST')->diffForHumans() }}</small></h3>
	</div>
</div>

@include('game.weather')

@php
	$response = $attendance;
@endphp

@foreach($games as $key => $game)

@if(count($games) > 1)
<div class="row justify-content-center mb-2">
	<div class="col-md-6">
		<h4 class="mb-0 text-white">Game {{ $key + 1  }}</h4>
	</div>
</div>
@else 

@include('game.info_header')

@endif

@include('game.canceled')
@include('game.settings')

@include('game.info')

@php

	$attendance = $response[$game['id']];

@endphp

@include('game.attendance')

@endforeach

@endsection