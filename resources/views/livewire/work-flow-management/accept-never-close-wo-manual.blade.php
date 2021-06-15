
<div class="body p-0">
    <canvas id="chart-3" style="height:400px;"></canvas>
</div>
@push('after-scripts')
<script>
Livewire.on('chart',()=>{
    
});
Livewire.on('chart-accept-never-close-wo-manual',(data)=>{
    var labels_2 = JSON.parse(data.labels);
    var series_2 = JSON.parse(data.series);
    init_chart_accept_never_close_wo_manual(labels_2,series_2);
});
var chart_2="";
function init_chart_accept_never_close_wo_manual(labels_2,series_2){
    if(chart_2!=="") chart_2.destroy();
    var config = {
        type: 'line',
        data: {
            labels: labels_2,
            datasets: series_2
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
                text: 'Accept Never Close WO Manual'
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
    var ctx = document.getElementById('chart-3').getContext('2d');
    chart_2 = new Chart(ctx, config);
}
</script>
@endpush
