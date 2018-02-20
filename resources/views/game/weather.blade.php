<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>

<div class="row justify-content-center mb-2">
	<div class="col-md-6">
		<h4 class="mb-0 text-white">Weather Forecast</h4>
	</div>
</div>
<div class="row mb-4 justify-content-center">
	<div class="col-md-6">
		<div class="card card-inverse card-outline-secondary">
			<div class="card-block">
				<p class="mb-2">{{ $forecast['daily_summary'] }}</p>
				<p class="mb-4">Game Time Temperature: {{ $forecast['temp_at_game_time'] }}</p>
				<canvas id='precip_probability'></canvas>
				
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	
var data = {
	labels: {!! $forecast['precip_probability_labels'] !!}, 
	datasets: [
		{
			label: '% Chance of Precipitation',
			data: {{ $forecast['precip_probabilities'] }},
			backgroundColor: [
                'rgba(0,0,100, 0.2)'
            ],
		}
	],

	options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
}

var context = document.querySelector('#precip_probability').getContext('2d');

new Chart(context , {
    type: "line",
    data: data, 
});

</script>