<div class="row justify-content-center">
	<div class="col-md-6">

		<div class="card card-outline-success mb-2">
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

		<div class="card card-outline-danger mb-2">
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

		<div class="card card-outline-secondary mb-2">
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
