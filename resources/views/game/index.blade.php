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

	<div class="card card-inverse card-outline-danger mb-2">
		<h4 class="card-header">Attendance</h4>
		<div class="card-block">

			<ul class="list-group list-group-flush">

				@foreach($attendanceList as $player => $player_info)

					<li class="list-group-item bg-inverse li">
						
						{{ dd($player_info) }}

					</li>

				@endforeach
			</ul>

			

		</div>
	</div>

@endsection