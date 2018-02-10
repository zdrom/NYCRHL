@extends('layouts.master')

@include('layouts.navbar')

@section('content')


@foreach($games as $game => $details)

	@component('games.game')

		@slot('header')

			{{ $details->home_team }} vs. {{ $details->away_team }}
 
		@endslot

		@slot('title')

			{{ $details->date }} <small class="text-muted">{{ \Carbon\Carbon::parse($details->date)->diffForHumans() }}</small>

		@endslot

		@slot('body')

		<figure class="icons">
		        <canvas id="rain" width="16" height="16">
		        </canvas>
		</figure>

{{-- 			{{ \App\Weather::gameTimeForecast($details->date)['summary'] }}
 --}}
		@endslot

	@endcomponent

@endforeach

@endsection