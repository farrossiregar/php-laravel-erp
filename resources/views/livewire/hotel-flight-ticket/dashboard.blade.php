<div>
    <div class="row">
        <div class="col-md-1">                
            <select class="form-control" wire:model="year">
                <option value=""> --- Year --- </option>
                <?php
                    $year = date('Y');
                    for($i = $year; $i >= ($year - 5); $i--){
                ?>
                <option><?php echo $i; ?></option>
                <?php
                    }
                ?>
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

    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="header">
                    <h2>Annual request Hotel only by Category</h2>
                    <!-- <ul class="header-dropdown">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a href="javascript:void(0);">Action</a></li>
                                <li><a href="javascript:void(0);">Another Action</a></li>
                                <li><a href="javascript:void(0);">Something else</a></li>
                            </ul>
                        </li>
                    </ul> -->
                </div>
                <div class="body">
                    <div id="m_donut_chart1"></div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="header">
                    <h2>Annual request Hotel & Flight by Category</h2>
                </div>
                <div class="body">
                    <div id="m_donut_chart2"></div>
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
var pie1 = {!!$pie1!!};
var pie2 = {!!$pie2!!};
// var colors = ['#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];



$( document ).ready(function() {

    init_chart_databasenoc();
});
Livewire.on('init-chart',(data)=>{
    labels = JSON.parse(data.labels);
    datasets = JSON.parse(data.datasets);
    pie1 = JSON.parse(data.pie1);
    pie2 = JSON.parse(data.pie2);

    
    datasetsamount = JSON.parse(data.datasetsamount);
    init_chart_databasenoc();
});
function init_chart_databasenoc(){
    var colors = ['#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];
    var chBar = document.getElementById("chBar");
    var chBar1 = document.getElementById("chBar1");
    var pie1 = document.getElementById("m_donut_chart1");
    var pie2 = document.getElementById("m_donut_chart2");
                       
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

    if (pie1) {
        Morris.Donut({
            element: 'm_donut_chart1',
            data: [
            {
                label: "Online Sales",
                value: 45,

            }, {
                label: "Store Sales",
                value: 35
            },{
                label: "Email Sales",
                value: 8
            }, {
                label: "Agent Sales",
                value: 12
            }],

            resize: true,
            colors: ['#2cbfb7', '#3dd1c9', '#60ded7', '#a1ece8']
        });
    }

    if (pie2) {
        Morris.Donut({
            element: 'm_donut_chart2',
            data: [
            {
                label: "Online Sales",
                value: 45,

            }, {
                label: "Store Sales",
                value: 35
            },{
                label: "Email Sales",
                value: 8
            }, {
                label: "Agent Sales",
                value: 12
            }],

            resize: true,
            colors: ['#2cbfb7', '#3dd1c9', '#60ded7', '#a1ece8']
        });
    }

}
</script>
@endpush