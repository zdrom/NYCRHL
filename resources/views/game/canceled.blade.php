<div class="row mb-2 justify-content-center">
	<div class="col-md-6">
		@if($game['canceled'])
			<div class="alert alert-danger" role="alert">
				<h5 class="mb-0">This game has been canceled</h5>
			</div>
		@endif

		@if($game['note'] !== NULL)
			<hr>
			<p class="mb-0">{{ $game['note'] }}</p>
		@endif
	</div>
</div>