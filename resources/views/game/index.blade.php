@extends('layouts.master')

@section('content')

@if($game->canceled)
<div class="alert alert-danger" role="alert">
  <h5 class="mb-0">This game has been canceled</h5>
  
  @if($game->note !== NULL)
  <hr>
  <p class="mb-0">{{ $game->note }}</p>
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

				{{ \Carbon\Carbon::parse($game->date)->format('l, F j') }}

			@endslot

			@slot('time')

				{{ \Carbon\Carbon::parse($game->date)->format('g:i a') }} <small class="text-muted">{{ \Carbon\Carbon::parse($game->date)->diffForHumans() }}</small>

			@endslot

			@slot('body')

			{{ $game->home_team }} vs. {{ $game->away_team }}

			@endslot

		@endcomponent
	</div>
</div>
<div class="row mb-2 justify-content-center">
	<div class="col-md-6">
		<div class="card card-inverse card-outline-secondary">
			<h5 class="card-header">Weather</h5>
			<div class="card-block">

			</div>
		</div>
	</div>
</div>
<div class="row mb-2 justify-content-center">
	<div class="col-md-6">
		<div class="card card-outline-success">
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
	</div>
</div>
<div class="row mb-2 justify-content-center">
	<div class="col-md-6">
		<div class="card card-outline-danger">
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
	</div>
</div>
<div class="row mb-2 justify-content-center">
	<div class="col-md-6">
		<div class="card card-outline-secondary ">
			<div class="card-header">
				<h5 class="mb-0">Maybe</h5>
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
</div>

@auth

<div class="row mb-2 justify-content-center">
	<div class="col-md-6">

		<div class="card card-inverse card-outline-secondary">
			<div class="card-header">
				<h5 class="mb-0">Settings</h5>
			</div>
			<div class="card-block">

				<button class="btn btn-outline-secondary btn-block" type="button" data-toggle="collapse" data-target="#updateStatus" aria-expanded="false" aria-controls="collapseExample">
				    Update Status
				</button>

				<div class="row justify-content-center">
					<div class="col-11">
						<div class="collapse mt-2" id="updateStatus">
							<form method="POST" action="/player/status">

								{{ csrf_field() }}

								<input type="hidden" name="game_id" value={{ $game->id }}>

								<div class="mb-2">
									<select class="form-control" id="status_picker" name="status">
								      <option value="yes">In</option>
								      <option value="no">Out</option>
								      <option value="NR">Maybe</option>
									</select>
								</div>
								<div class="mb-2 mt-2">
									<input type="submit" class="btn btn-outline-success btn-block" value="Confirm">
								</div>

							</form>
						</div>
					</div>
				</div>

				<button class="btn btn-outline-secondary btn-block mt-2" type="button" data-toggle="collapse" data-target="#cancelGame" aria-expanded="false" aria-controls="collapseExample">
				    Cancel Game
				</button>

				<div class="row justify-content-center">
					<div class="col-11">
						<div class="collapse" id="cancelGame">
						    <form method="POST" action="/game/cancel">

						    	{{ csrf_field() }}

						    	<input type="hidden" name="game_id" value={{ $game->id }}>
						    	<input type="hidden" name="team_id" value={{ $team->id }}>

						    	<div class="mb-2 mt-2">
						    		<textarea class="form-control" name="note" id="note" rows="3" placeholder="Note (Not Required)"></textarea>
						    	</div>
						    	<div>
						    		<input type="submit" class="btn btn-outline-danger btn-block" value="Confirm">
						    	</div>
						    </form>
						</div>
					</div>
				</div>

				@if(Auth::user()->manager)

					<button class="btn btn-outline-secondary btn-block mt-2" type="button" data-toggle="collapse" data-target="#reschedule" aria-expanded="false" aria-controls="collapseExample">
					    Reschedule Game
					</button>
					
					<div id="root">
						<div class="row justify-content-center">
							<div class="col-11">
								<div class="collapse" id="reschedule">
								    <form method="POST" action="/game/reschedule">

								    	{{ csrf_field() }}

								    	<input type="hidden" name="game_id" value={{ $game->id }}>

								    	<div class="mb-2 mt-2">
								    		<input name="date" class="form-control" id="datetime-local" type="datetime-local" value={{ \Carbon\Carbon::parse($game->date)->format('Y\-m\-d\TH\:m') }}>
								    	</div>
								    	<div>
								    		<input type="submit" class="btn btn-outline-success btn-block" value="Confirm">
								    	</div>
								    </form>
								</div>
							</div>
						</div>
					</div>

				@endif
				
			</div>
		</div>
	</div>
</div>

@endauth

@endsection