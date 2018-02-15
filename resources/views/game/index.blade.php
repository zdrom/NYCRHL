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

<div class="row mb-2 justify-content-center">
	<div class="col-md-6">
		@component('game.game')

			@slot('header')
				Game Info 
			@endslot

			@slot('date')

				{{ \Carbon\Carbon::parse($game['date'])->format('l, F j') }}

			@endslot

			@slot('time')

				{{ \Carbon\Carbon::parse($game['date'])->format('g:i a') }} <small class="text-muted">{{ \Carbon\Carbon::parse($game['date'])->diffForHumans() }}</small>

			@endslot

			@slot('body')

			{{ $game['home_team'] }} vs. {{ $game['away_team'] }}

			@endslot

		@endcomponent
	</div>
</div>

@include('game.weather')

@include('game.attendance')

@include('game.settings')

@endsection