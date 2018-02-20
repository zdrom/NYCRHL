@extends('layouts.master')

@section('content')

<div class="row justify-content-center">
	<div class="col-md-6">
		<h3 class="mb-0 text-white">{{ \Carbon\Carbon::parse($game['date'] . 'EST')->format('l, F j')  }}</h3>
	</div>
</div>
<div class="row justify-content-center">
	<div class="col-md-6">
		<h3 class="mb-0 text-white">{{ \Carbon\Carbon::parse($game['date'] . 'EST')->format('\a\t\ g:i a')  }}</h3>
	</div>
</div>
<div class="row mb-4 justify-content-center">
	<div class="col-md-6">
		<h3 class="mb-0"><small class="text-muted">{{ \Carbon\Carbon::parse($game['date'] . 'EST')->diffForHumans() }}</small></h3>
	</div>
</div>

@include('game.canceled')

@include('game.settings')

@if(\Carbon\Carbon::parse($game['date'] . 'EST')->diffInDays(\Carbon\Carbon::now()) < 5 && \Carbon\Carbon::parse($game['date'] . 'EST')->isFuture())

@include('game.weather')

@endif

@include('game.info_header')
@include('game.info')

@include('game.attendance')

@endsection