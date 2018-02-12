@extends('layouts.master')

@section('content')

	@component('game.game')

		@slot('header')

			{{ \Carbon\Carbon::parse($game->date)->format('l, F j') }} 
		@endslot

		@slot('title')

			{{ \Carbon\Carbon::parse($game->date)->format('g:i a') }} <small class="text-muted">{{ \Carbon\Carbon::parse($game->date)->diffForHumans() }}</small>

		@endslot

		@slot('body')

		{{ $game->home_team }} vs. {{ $game->away_team }}

		@endslot

	@endcomponent

	<div class="card card-inverse card-outline-danger mb-2">
		<h4 class="card-header">Chance of rain at game time: {{ $chanceOfRainAtGameTime }}</h4>
		<div class="card-block">

		</div>
	</div>

	<div class="card card-outline-success mb-2">
		<div class="card-header bg-success">
			<h5 class="mb-0">In</h5>
		</div>
		<ul class="list-group list-group-flush">
	
			@foreach($attendance as $name => $response)
				@if($response == 'yes')
				<li class="list-group-item bg-inverse card-inverse">{{ $name }}</li>
				@endif
			@endforeach

		</ul>
	</div>

	<div class="card card-outline-danger mb-2">
		<div class="card-header bg-danger">
			<h5 class="mb-0">Out</h5>
		</div>
		<ul class="list-group list-group-flush">
	
			@foreach($attendance as $name => $response)
				@if($response == 'no')
				<li class="list-group-item list-group-item bg-inverse card-inverse">{{ $name }}</li>
				@endif
			@endforeach

		</ul>
	</div>

	<div class="card card-outline-secondary ">
		<div class="card-header">
			<h5 class="mb-0">No Response</h5>
		</div>
		<ul class="list-group list-group-flush">
	
			@foreach($attendance as $name => $response)
				@if($response == 'NR')
				<li class="list-group-item list-group-item bg-inverse card-inverse">{{ $name }}</li>
				@endif
			@endforeach

		</ul>
	</div>

	</div>

@endsection