<div class="row justify-content-center mb-2">
	<div class="col-md-6">
		<h4 class="mb-0 text-white">Attendance</h4>
	</div>
</div>
<div class="row justify-content-center mb-4">
	<div class="col-md-6">

		@if(in_array('yes',$attendance))

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

		@endif

		@if(in_array('no',$attendance))

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

		@endif

		@if(in_array('maybe',$attendance) || in_array('NR',$attendance))

		<div class="card card-outline-secondary mb-2">
			<div class="card-header">
				<h5 class="mb-0">Maybe</h5>
			</div>
			<ul class="list-group list-group-flush">

				@foreach($attendance as $name => $response)
					@if($response == 'NR' || $response == 'maybe')
					<li class="list-group-item list-group-item bg-inverse card-inverse">{{ $name }}</li>
					@endif
				@endforeach

			</ul>
		</div>

		@endif
		
	</div>
</div>