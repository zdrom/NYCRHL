@auth

<div class="row mb-2 justify-content-center">
	<div class="col-md-6">

		<div class="card card-inverse card-outline-secondary">
			<div class="card-header">
				<h5 class="mb-0">Settings</h5>
			</div>
			<div class="card-block">

				<button class="btn btn-outline-secondary btn-block" type="button" data-toggle="collapse" data-target="#updateStatus{{ $game['id'] }}" aria-expanded="false" aria-controls="collapseExample">
				    Update Status
				</button>

				<div class="row justify-content-center">
					<div class="col-8">
						<div class="collapse mt-2" id="updateStatus{{ $game['id'] }}">
							<form method="POST" action="/player/status">

								{{ csrf_field() }}

								<input type="hidden" name="game_id" value={{ $game['id'] }}>

								<div class="mb-2">
									<select class="form-control" id="status_picker" name="status">
								      <option value="yes">In</option>
								      <option value="no">Out</option>
								      <option value="NR">Maybe</option>
									</select>
								</div>
								<div class="mb-2 mt-2">
									<input type="submit" class="btn btn-outline-secondary btn-block" value="Confirm">
								</div>

							</form>
						</div>
					</div>
				</div>

				<button class="btn btn-outline-secondary btn-block mt-2" type="button" data-toggle="collapse" data-target="#cancelGame{{ $game['id'] }}" aria-expanded="false" aria-controls="collapseExample">
				    Cancel Game
				</button>

				<div class="row justify-content-center">
					<div class="col-8">
						<div class="collapse" id="cancelGame{{ $game['id'] }}">
						    <form method="POST" action="/game/cancel">

						    	{{ csrf_field() }}

						    	<input type="hidden" name="game_id" value={{ $game['id'] }}>
						    	<input type="hidden" name="team_id" value={{ $team['id'] }}>

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

					<button class="btn btn-outline-secondary btn-block mt-2" type="button" data-toggle="collapse" data-target="#reschedule{{ $game['id'] }}" aria-expanded="false" aria-controls="collapseExample">
					    Reschedule Game
					</button>
					
					<div id="root">
						<div class="row justify-content-center">
							<div class="col-8">
								<div class="collapse" id="reschedule{{ $game['id'] }}">
								    <form method="POST" action="/game/reschedule">

								    	{{ csrf_field() }}

								    	<input type="hidden" name="game_id" value={{ $game['id'] }}>

								    	<div class="mb-2 mt-2">
								    		<input name="date" class="form-control" id="datetime-local" type="datetime-local" value={{ \Carbon\Carbon::parse($game['date'])->format('Y\-m\-d\TH\:i') }}>
								    	</div>
								    	<div>
								    		<input type="submit" class="btn btn-outline-secondary btn-block" value="Confirm">
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