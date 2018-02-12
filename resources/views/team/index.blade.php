@extends('layouts.master')

@section('content')


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

		{{ $details->home_team }} vs. {{ $details->away_team }}

		@endslot

	@endcomponent

@endforeach

@endsection