<div class="body p-0">
    <canvas id="chart-2" style="height:400px;"></canvas>
</div>
@push('after-scripts')
<script>
Livewire.on('chart-assigned-never-accept-wo',(data)=>{
    var labels_3 = JSON.parse(data.labels);
    var series_3 = JSON.parse(data.series);
    init_chart_assigned_never_accept_wo(labels,series);
});
var chart_3="";
function init_chart_assigned_never_accept_wo(labels_3,series_3){
    if(chart_3!=="") chart_3.destroy();
    var config = {
        type: 'line',
        data: {
            labels: labels_3,
            datasets: series_3
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
                text: 'Assigned Never Accept WO'
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
    var ctx = document.getElementById('chart-2').getContext('2d');
    chart_3 = new Chart(ctx, config);
}
</script>
@endpush
