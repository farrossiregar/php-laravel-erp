<div>
    <div class="header row py-0">
        <div class="col-md-1">
            <select class="form-control" wire:model="year">
                @foreach(\App\Models\WorkFlowManagement::select(\DB::raw('YEAR(date) as tahun'))->groupBy('tahun')->get() as $item)
                <option>{{$item->tahun}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2 px-0">
            <select class="form-control" wire:model="month">
                <option value=""> --- Month --- </option>
                @foreach(\App\Models\WorkFlowManagement::select(\DB::raw('MONTH(date) as bulan'))->whereYear('date',$year)->groupBy('bulan')->get() as $item)
                <option value="{{$item->bulan}}">{{date('F', mktime(0, 0, 0, $item->bulan, 10))}}</option>
                @endforeach
            </select>
        </div>
        <div class="text-center mt-1 ml-2" wire:loading>
            <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <div class="body p-0">
        <canvas id="chart-2"></canvas>
    </div>
</div>
@push('after-scripts')
<script>
Livewire.on('chart-assigned-never-accept-wo',(data)=>{
    var labels = JSON.parse(data.labels);
    var series = JSON.parse(data.series);
    init_chart_assigned_never_accept_wo(labels,series);
});
function init_chart_assigned_never_accept_wo(labels,series){
    if(chart!=="") chart.destroy();
    var config = {
        type: 'line',
        data: {
            labels: labels,
            datasets: series
        },
        options: {
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
                text: ''
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
    chart = new Chart(ctx, config);
}
</script>
@endpush
