<div>
    <div class="header row">
        <div class="col-md-1">
            <select class="form-control" wire:model="year">
                @foreach(\App\Models\CustomerAssetManagement::select(\DB::raw('YEAR(tanggal_submission) as tahun'))->groupBy('tahun')->get() as $item)
                @if(empty($item->tahun))@continue @endif
                <option>{{$item->tahun}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2" wire:ignore>
            <select class="multiselect multiselect-custom multiselect_month" style="width:100%;" wire:model="month" multiple="multiple">
                @foreach(\App\Models\CustomerAssetManagement::select(\DB::raw('MONTH(tanggal_submission) as month'))->where(function($table) use ($year){ if($year) $table->whereYear('tanggal_submission',$year); })->groupBy('month')->get() as $item)
                @if(empty($item->month))@continue @endif
                <option value="{{$item->month}}">{{date('F', mktime(0, 0, 0, $item->month, 10))}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2" wire:ignore>
            <select class="multiselect multiselect-custom multiselect_region" wire:model="region" multiple="multiple">
                @foreach(\App\Models\CustomerAssetManagement::groupBy('region_name')->get() as $item)
                @if(empty($item->region_name))@continue @endif
                <option>{{$item->region_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-9 pt-2">
            <label wire:loading>
                <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                <span class="sr-only">{{ __('Loading...') }}</span>
            </label>
        </div>
    </div>
    <div class="body p-0">
        <canvas id="line-chart" style="height:400px;"></canvas>
    </div>
</div>
@push('after-scripts')
<script src="{{ asset('assets/vendor/chartjs/Chart.bundle.min.js') }}?v=2"></script>
<script src="{{ asset('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
<script>
var labels = {!!$labels!!};
var datasets = {!!$datasets!!};
var chart="";
$( document ).ready(function() {
    init_chart();
    $('.multiselect_region').multiselect({ 
            nonSelectedText: ' --- All Region --- ',
            onChange: function (option, checked) {
                @this.set('region', $('.multiselect_region').val());
            },
            buttonWidth: '100%'
        }
    );
    $('.multiselect_month').multiselect({ 
            nonSelectedText: ' --- All Month --- ',
            onChange: function (option, checked) {
                @this.set('month', $('.multiselect_month').val());
            },
            buttonWidth: '100%'
        }
    );
});
Livewire.on('chart-customer-asset',()=>{
    setTimeout(function(){
        init_chart();
    },1000);
});
Livewire.on('init-chart',(data)=>{
    labels = JSON.parse(data.labels);
    datasets = JSON.parse(data.datasets);
    init_chart();
});
function init_chart(){
    if(chart!=="") chart.destroy();
    var config = {
        type: 'line',
        data: {
            labels: labels,
            datasets: datasets
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
                text: 'BATTERY CAGE INSTALL'
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
    var ctx = document.getElementById('line-chart').getContext('2d');
    chart = new Chart(ctx, config);
}
</script>
@endpush