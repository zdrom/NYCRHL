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
@endif

<div class="row justify-content-center">
	<div class="col-md-6">
		<div class="card card-inverse card-outline-secondary mb-2">
			<h5 class="card-header">{{ \Carbon\Carbon::parse($game['date'] . 'EST')->format('g:i a') }} </h5>
			<div class="card-block">
				<p>{{ $game['home_team'] }} vs. {{ $game['away_team'] }}</p>
			</div>
		</div>
	</div>
</div>
@php

	$attendance = $response[$game['id']];

@endphp

@include('game.attendance')
@include('game.settings')

@endforeach
				
@include('game.weather')

@endsection