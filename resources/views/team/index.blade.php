@extends('layouts.master')

@section('content')

<div class="row justify-content-center mb-2">
	<div class="col-md-6">
		<h2 class="mb-0 text-white">{{ $team->name }}</h2>
	</div>
</div>

@foreach($games as $game => $details)

	@component('schedule.game')

		@slot('url')
		
			{{ Request::url() }}/game/{{ $details->id }}

		@endslot

		@slot('header')

			{{ \Carbon\Carbon::parse($details->date)->format('l, F j') }} 
		@endslot

		@slot('title')

			{{ \Carbon\Carbon::parse($details->date)->format('g:i a') }} <small class="text-muted">{{ \Carbon\Carbon::parse($details->date)->diffForHumans() }}</small>

		@endslot

		@slot('body')

		vs. @if($details->home_team == Auth::user()->team->name) {{ $details->away_team }} @else {{ $details->home_team }} @endif

		@endslot

	@endcomponent

@endforeach

@endsection