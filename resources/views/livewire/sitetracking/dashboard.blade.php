<div>
    <div class="row">
        <div class="col-md-1">                
            <select class="form-control" wire:model="year">
                <option value=""> --- Year --- </option>
                @foreach(\App\Models\SiteListTrackingDetail::select(\DB::raw('YEAR(period) as tahun'))->groupBy('tahun')->get() as $item) 
                <option>{{$item->tahun}}</option>
                @endforeach 
            </select>
        </div>
        <div class="col-md-2" wire:ignore>
            <select class="multiselect multiselect-custom multiselect_month" style="width:100%;" wire:model="month" multiple="multiple">
                @foreach(\App\Models\SiteListTrackingDetail::select(\DB::raw('MONTH(period) as month'))->groupBy('month')->orderBy('month','ASC')->get() as $item)
                @if(empty($item->month))@continue @endif
                <option value="{{$item->month}}">{{date('F', mktime(0, 0, 0, $item->month, 10))}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-1">                
            <select class="form-control" wire:model="region_id">
                <option value=""> -- Region -- </option>
                @foreach($regions as $item) 
                    @if(!isset($item->region_->id)) @continue @endif
                    <option value="{{$item->region_id}}">{{$item->region_->region}}</option>
                @endforeach 
            </select>
        </div>
        <div class="col-md-7">
            <label wire:loading>
                <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                <span class="sr-only">{{ __('Loading...') }}</span>
            </label>
        </div>
    </div>
    <div class="mt-4" style="height: 300px">
        <canvas id="chBar"></canvas>
    </div>
</div>
@push('after-scripts')
<script src="{{ asset('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
<script src="{{ asset('assets/vendor/chartjs/Chart.bundle.min.js') }}?v=2"></script>
<script>
var labels = {!!$labels!!};
var datasets = {!!$datasets!!};

$( document ).ready(function() {
    $('.multiselect_month').multiselect({ 
            nonSelectedText: ' --- All Month --- ',
            onChange: function (option, checked) {
                @this.set('month', $('.multiselect_month').val());
            },
            buttonWidth: '100%'
        }
    );
    init_chart_sitelisttracking();
});
Livewire.on('init-chart',(data)=>{
    labels = JSON.parse(data.labels);
    datasets = JSON.parse(data.datasets);
    init_chart_sitelisttracking();
});
function init_chart_sitelisttracking(){
    var colors = ['#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];
    var chBar = document.getElementById("chBar");
                       
    if (chBar) {
        new Chart(chBar, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: datasets,
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
                legend: {
                    display: true,
                    position:'bottom'
                },
                title: {
                    display: true,
                    text: '{{$project_name}}'
                },
                scales: {
                    xAxes: [{
                        barPercentage: 0.4,
                        categoryPercentage: 0.5
                    }]
                }
            }
        });
    }
}
</script>
@endpush