<div class="body p-0">
    <canvas id="chart-wo-never-assign" style="height:400px;"></canvas>
</div>
@push('after-scripts')
<script>
var labels = {!!$labels!!};
var series = {!!$series!!};
var chart="";
$( document ).ready(function() {
    init_chart_wo_never_assign();
});
Livewire.on('init-chart',(data)=>{
    labels = JSON.parse(data.labels);
    series = JSON.parse(data.series);
    init_chart_wo_never_assign();
});
function init_chart_wo_never_assign(){
    if(chart!=="") chart.destroy();
    var config = {
        type: 'line',
        data: {
            labels: labels,
            datasets: series
        },
        options: {
            maintainAspectRatio: false,
            elements: {
				line: {
					tension: 0.000001
				}
			},
            legend: {
						position: 'bottom',
					},
            responsive: true,
            title: {
                display: true,
                text: 'WO Never Assigned'
            },
            tooltips: {
                mode: 'index',
                intersect: false,
            },
            hover: {
                mode: 'nearest',
                intersect: true
            },
            scales: {
                xAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Date'
                    }
                }],
                yAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Value'
                    }
                }]
            }
        }
    };
    var ctx = document.getElementById('chart-wo-never-assign').getContext('2d');
    chart = new Chart(ctx, config);
}
</script>
@endpush
