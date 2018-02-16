<div class="row mb-4 justify-content-center">
	<div class="col-md-6">
		<div class="card card-inverse card-outline-secondary">
			<div class="card-block">
				<p class="mb-2">{{ \Carbon\Carbon::parse($game['date'] . 'EST')->format('l, F j')  }}</p>
				<p class="mb-2">{{ \Carbon\Carbon::parse($game['date'] . 'EST')->format('g:i a')  }}</p>
				<p class="mb-0">vs. @if($game['home_team'] == Auth::user()->team->name) {{ $game['away_team'] }} @else {{ $game['home_team'] }} @endif</p>
			</div>
		</div>
	</div>
</div>

