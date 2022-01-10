<div>
    <div class="row">
        <div class="col-md-1">                
            <select class="form-control" wire:model="year">
                <option value=""> --- Year --- </option>
                @foreach(\App\Models\ToolsNoc::select('year')->groupBy('year')->whereNotNull('year')->get() as $item) 
                <option>{{$item->year}}</option>
                @endforeach 
            </select>
        </div>

        <div class="col-md-2" wire:ignore>
            <select class="form-control" style="width:100%;" wire:model="month">
                <option value=""> --- Month --- </option>
                @for($i = 1; $i <= 12; $i++)
                    <option value="{{$i}}">{{date('F', mktime(0, 0, 0, $i, 10))}}</option>
                @endfor
            </select>
        </div>

        <div class="col-md-1">                
            <select class="form-control" wire:model="project">
                <option value=""> --- Project --- </option>
                @foreach(\App\Models\ClientProject::orderBy('id', 'desc')
                                ->where('company_id', Session::get('company_id'))
                                ->where('is_project', '1')
                                ->get() as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        
        
        <div class="col-md-3">
            <label wire:loading>
                <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                <span class="sr-only">{{ __('Loading...') }}</span>
            </label>
        </div>
    </div>

    <div class="col-md-4">
        <!-- <div class="card">
            <div class="header">
                <h2>Browser Usage</h2>
                <ul class="header-dropdown">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="javascript:void(0);">Action</a></li>
                            <li><a href="javascript:void(0);">Another Action</a></li>
                            <li><a href="javascript:void(0);">Something else</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="body text-center">
                <div id="donut_chart" class="dashboard-donut-chart m-b-35"></div>
                <div class="row">
                    <div class="col-lg-2 col-4">
                        <h6>Crome</h6>
                        <p>35<sup>%</sup></p>
                    </div>
                    <div class="col-lg-2 col-4">
                        <h6>Safari</h6>
                        <p>25<sup>%</sup></p>
                    </div>                                
                    <div class="col-lg-2 col-4">
                        <h6>Mozila</h6>
                        <p>25<sup>%</sup></p>
                    </div>
                    <div class="col-lg-2 col-4">
                        <h6>Opera</h6>
                        <p>3<sup>%</sup></p>
                    </div>
                    <div class="col-lg-2 col-4">
                        <h6>IE</h6>
                        <p>7<sup>%</sup></p>
                    </div>
                    <div class="col-lg-2 col-4">
                        <h6>Others</h6>
                        <p>5<sup>%</sup></p>
                    </div>
                </div>
            </div>
        </div> -->

        <div class="card info-box-2">
            <div class="body">
                <div class="icon">
                    <div class="chart chart-pie">30, 35, 25, 8</div>
                </div>
                <div class="content">
                    <div class="text">Usage</div>
                    <div class="number">98%</div>
                </div>
            </div>
        </div>
    </div>
        
    <div class="mt-4" style="height: 300px">
        <canvas id="chBar"></canvas>
    </div>

    <div class="mt-4" style="height: 300px">
        <canvas id="chBar1"></canvas>
    </div>
</div>
@push('after-scripts')
<script src="{{ asset('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
<script src="{{ asset('assets/vendor/chartjs/Chart.bundle.min.js') }}?v=2"></script>

<script>
var labels = {!!$labels!!};
var datasets = {!!$datasets!!};
var datasetsamount = {!!$datasetsamount!!};
// var colors = ['#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];

// var dataslt = [];
// for(var i = 0; i < series.length; i++)  {
//     dataslt.push({
//             data: series[i],
//             backgroundColor: colors[i],
//             borderColor: colors[i],
//             borderWidth: 4,
//             pointBackgroundColor: colors[0]
//         });
// }

$( document ).ready(function() {
    // $('.multiselect_month').multiselect({ 
    //         nonSelectedText: ' --- All Month --- ',
    //         onChange: function (option, checked) {
    //             @this.set('month', $('.multiselect_month').val());
    //         },
    //         buttonWidth: '100%'
    //     }
    // );
    init_chart_databasenoc();
});
Livewire.on('init-chart',(data)=>{
    labels = JSON.parse(data.labels);
    datasets = JSON.parse(data.datasets);

    
    datasetsamount = JSON.parse(data.datasetsamount);
    init_chart_databasenoc();
});
function init_chart_databasenoc(){
    var colors = ['#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];
    var chBar = document.getElementById("chBar");
    var chBar1 = document.getElementById("chBar1");
                       
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
                    text: 'REQUEST TICKET - MONTHLY'
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

    if (chBar1) {
        new Chart(chBar1, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: datasetsamount,
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
                    text: 'AMOUNT SPENT - MONTHLY'
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