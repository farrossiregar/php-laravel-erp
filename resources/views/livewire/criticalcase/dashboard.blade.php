<div>
    <div class="body pt-0">
        <div class="row my-2">
            <div class="col-md-2" wire:ignore>
                <select class="multiselect multiselect-custom multiselect_action_point" style="width:100%;" wire:model="action_point" multiple="multiple">
                    <option value="1">[R] Repetitive</option>
                    <option value="2">[N] Non Repetitive</option>
                </select>
            </div>
            <div class="col-md-1">
                <select class="form-control" wire:model="year">
                    <option value="">{{__('-- Year -- ')}}</option>
                    @foreach(\App\Models\CriticalCase::select(\DB::raw('YEAR(date) as tahun'))->groupBy('tahun')->get() as $item)
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
                    <div class="row">
                        <div class="col-md-10">
                            <div class="card-body">
                                <canvas id="chBarCriticalcase" style="height:300px;"></canvas>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card-body">
                                <canvas id="pie_chart" style="height:300px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>     
    </div>
</div>
@section('page-script')
Livewire.on('sitetracking-upload',()=>{
    $("#modal-sitetracking-upload").modal('hide');
});
@endsection
@push('after-scripts')
<script src="{{ asset('assets/vendor/chartjs/Chart.bundle.min.js') }}?v=2"></script>
<script src="{{ asset('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
<script>
var labels = {!!$labels!!};
var datasets = {!!$datasets!!};
var labels_pie = {!!$labels_pie!!};
var datasets_pie = {!!$datasets_pie!!};

var colors = ['#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];
var chBarCriticalcase = "";
var pieStolen = "";
$( document ).ready(function() {
    init_chart_critical_case();
    init_pie_critical_case();

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
    $('.multiselect_action_point').multiselect({ 
            nonSelectedText: ' --- Action Point --- ',
            onChange: function (option, checked) {
                @this.set('action_point', $('.multiselect_action_point').val());
            },
            buttonWidth: '100%'
        }
    );
});

Livewire.on('init-chart-critical-case',(data)=>{
    labels = JSON.parse(data.labels);
    datasets = JSON.parse(data.datasets);
    setTimeout(function(){
        init_chart_critical_case();
    },1000)
});

Livewire.on('chart-critical-case',()=>{
    setTimeout(function(){
        init_chart_critical_case();
    },1000);
});


function init_pie_critical_case()
{
    var pieOptions = {
            events: false,
            maintainAspectRatio: false,
            animation: {
                duration: 500,
                easing: "easeOutQuart",
                onComplete: function () {
                var ctx = this.chart.ctx;
                ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontFamily, 'normal', Chart.defaults.global.defaultFontFamily);
                ctx.textAlign = 'center';
                ctx.textBaseline = 'bottom';

                this.data.datasets.forEach(function (dataset) {

                    for (var i = 0; i < dataset.data.length; i++) {
                    var model = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._model,
                        total = dataset._meta[Object.keys(dataset._meta)[0]].total,
                        mid_radius = model.innerRadius + (model.outerRadius - model.innerRadius)/2,
                        start_angle = model.startAngle,
                        end_angle = model.endAngle,
                        mid_angle = start_angle + (end_angle - start_angle)/2;

                    var x = mid_radius * Math.cos(mid_angle);
                    var y = mid_radius * Math.sin(mid_angle);

                    ctx.fillStyle = '#fff';
                    if (i == 3){ // Darker text color for lighter background
                        ctx.fillStyle = '#444';
                    }
                    var percent = String(Math.round(dataset.data[i]/total*100)) + "%";
                    ctx.fillText(percent, model.x + x, model.y + y + 15);
                    }
                });               
                }
            }
        };

    if(pieStolen!=="") pieStolen.destroy();

    var colors = ['#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];
    pieStolen = document.getElementById("pie_chart");
                       
    pieStolen = new Chart(pieStolen, {
            type: 'pie',
            data: {
                labels: labels_pie,
                datasets: datasets_pie,
            },
            options : pieOptions 
        });
}

function init_chart_critical_case(){
    if(chBarCriticalcase!=="") chBarCriticalcase.destroy();
    var colors = ['#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];
    chBarCriticalcase = document.getElementById("chBarCriticalcase");
                       
    chBarCriticalcase = new Chart(chBarCriticalcase, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: datasets,
            },
            options: {
                title: {
                    display:true,
                    text : "EMERGENCY TREND {{isset($region)? ' - ' .implode(' & ', $region) : ''}}"
                },
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