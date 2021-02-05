<div class="body p-0">
    <canvas id="chart-4" style="height:400px;"></canvas>
</div>
@push('after-scripts')
<script>
Livewire.on('chart-total-ft-never-close-manual',(data)=>{
    var labels_4 = JSON.parse(data.labels);
    var series_4 = JSON.parse(data.series);
    init_chart_total_ft_never_close_manual(labels_4,series_4);
});
var chart_4="";
function init_chart_total_ft_never_close_manual(labels_4,series_4){
    if(chart_4!=="") chart_4.destroy();
    var config = {
        type: 'line',
        data: {
            labels: labels_4,
            datasets: series_4
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
                text: 'Total FT Never Close Manual'
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
    var ctx = document.getElementById('chart-4').getContext('2d');
    chart_4 = new Chart(ctx, config);
}
</script>
@endpush
