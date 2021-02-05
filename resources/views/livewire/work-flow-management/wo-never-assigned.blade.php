<div>
    <div class="header row">
        <div class="col-md-1">
            <select class="form-control" wire:model="year">
                @foreach(\App\Models\WorkFlowManagement::select(\DB::raw('YEAR(date) as tahun'))->groupBy('tahun')->get() as $item)
                <option>{{$item->tahun}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select class="form-control" wire:model="region">
                <option value=""> --- All Region --- </option>
                @foreach(\App\Models\WorkFlowManagement::groupBy('region')->get() as $item)
                <option>{{$item->region}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-9 pt-2">
            @foreach(\App\Models\WorkFlowManagement::select(\DB::raw('MONTH(date) as bulan'))->whereYear('date',$year)->groupBy('bulan')->get() as $item)
                <label class="fancy-checkbox">
                    <input type="checkbox" name="checkbox" wire:model="month.{{$item->bulan}}" value="{{$item->bulan}}" data-parsley-errors-container="#error-checkbox" data-parsley-multiple="checkbox">
                    <span>{{date('F', mktime(0, 0, 0, $item->bulan, 10))}}</span>
                </label>
            @endforeach
            <label wire:loading>
                <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                <span class="sr-only">{{ __('Loading...') }}</span>
            </label>
        </div>
    </div>
    <div class="body p-0">
        <canvas id="chart-wo-never-assign" style="height:400px;"></canvas>
    </div>
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
