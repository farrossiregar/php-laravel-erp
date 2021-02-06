@section('title', __('Critical Case Dashboard'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h6>EMERGENCY TREND {{isset($region)? ' - ' .implode(' & ', $region) : ''}}</h6>
            </div>
            <div class="body pt-0">
                <div class="row my-2">
                    <div class="col-md-1">
                        <select class="form-control" wire:model="year">
                            @foreach(\App\Models\WorkFlowManagement::select(\DB::raw('YEAR(date) as tahun'))->groupBy('tahun')->get() as $item)
                            <option>{{$item->tahun}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2" wire:ignore>
                        <select class="multiselect multiselect-custom multiselect_month" style="width:100%;" wire:model="month" multiple="multiple">
                            @foreach(\App\Models\CriticalCase::select(\DB::raw('MONTH(date) as month'))->groupBy('month')->get() as $item)
                            @if(empty($item->month))@continue @endif
                            <option value="{{$item->month}}">{{date('F', mktime(0, 0, 0, $item->month, 10))}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2" wire:ignore>
                        <select class="multiselect multiselect-custom multiselect_project" style="width:100%;" wire:model="project" multiple="multiple">
                            @foreach(\App\Models\CriticalCase::groupBy('project')->get() as $item)
                            @if(empty($item->project))@continue @endif
                            <option>{{$item->project}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2" wire:ignore>
                        <select class="multiselect multiselect-custom multiselect_region" wire:model="region" multiple="multiple">
                            @foreach(\App\Models\CriticalCase::groupBy('region')->get() as $item)
                            @if(empty($item->region))@continue @endif
                            <option>{{$item->region}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div wire:loading>
                        <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                        <span class="sr-only">{{ __('Loading...') }}</span>
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <canvas id="chBar" style="height:300px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>     
            </div>
        </div>
    </div>
</div>
@push('after-scripts')
<script src="{{ asset('assets/vendor/chartjs/Chart.bundle.min.js') }}?v=2"></script>
<script src="{{ asset('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
<style>
    .multiselect{
        border: 1px solid #ced4da
    }
</style>
<script>
var labels = {!!$labels!!};
var datasets = {!!$datasets!!};
var colors = ['#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];
var chBar="";
$( document ).ready(function() {
    init_chart_critical_case();
    $('.multiselect_project').multiselect({ 
            nonSelectedText: ' --- All Project --- ',
            onChange: function (option, checked) {
                @this.set('project', $('.multiselect_project').val());
            },
            buttonWidth: '100%'
        }
    );
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
Livewire.on('init-chart',(data)=>{
    labels = JSON.parse(data.labels);
    datasets = JSON.parse(data.datasets);
    init_chart_critical_case();
});
function init_chart_critical_case(){
    if(chBar!=="") chBar.destroy();
    var colors = ['#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];
    chBar = document.getElementById("chBar");
                       
    chBar = new Chart(chBar, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: datasets,
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    position: 'bottom',
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
</script>
@endpush