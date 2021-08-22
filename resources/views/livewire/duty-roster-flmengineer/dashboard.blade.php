<div>
    <div class="row">
        <div class="col-md-1">                
            <select class="form-control" wire:model="year">
                <option value=""> --- Year --- </option>
                @foreach(\App\Models\EmployeeNoc::select('year')->groupBy('year')->get() as $item) 
                <option>{{$item->year}}</option>
                @endforeach 
            </select>
        </div>
        <div class="col-md-2" wire:ignore>
            <select class="form-control" style="width:100%;" wire:model="month">
                <option value=""> --- Month --- </option>
                
                <?php
                    for($month = 1; $month <= 12; $month++){
                ?>
                <option value="{{$month}}">{{date('F', mktime(0, 0, 0, $month, 10))}}</option>
                <?php
                    }
                ?>
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
    <br>
    <div class="mt-4" style="height: 300px">
        <canvas id="chBar2"></canvas>
    </div>
    <br>
    <div class="mt-4" style="height: 300px">
        <canvas id="chBar3"></canvas>
    </div>
</div>
@push('after-scripts')
<script src="{{ asset('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
<script src="{{ asset('assets/vendor/chartjs/Chart.bundle.min.js') }}?v=2"></script>

<script>
var labels = {!!$labels!!};
// var labels = [];
var datasets = {!!$datasets!!};

var labelsorgflm = {!!$labelsorgflm!!};
var datasetsorgflm = {!!$datasetsorgflm!!};

var labelsorgmanagement = {!!$labelsorgmanagement!!};
var datasetsorgmanagement = {!!$datasetsorgmanagement!!};
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

    labelsorgflm = JSON.parse(data.labelsorgflm);
    datasetsorgflm = JSON.parse(data.datasetsorgflm);

    labelsorgmanagement = JSON.parse(data.labelsorgmanagement);
    datasetsorgmanagement = JSON.parse(data.datasetsorgmanagement);
    init_chart_databasenoc();
});
function init_chart_databasenoc(){
    var colors = ['#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];
    var chBar = document.getElementById("chBar");
    var chBar2 = document.getElementById("chBar2");
                       
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
                    text: 'DUTY ROSTER FLM ENGINEER'
                },
                scales: {
                    xAxes: [{
                        barPercentage: 0.5,
                        categoryPercentage: 0.5
                    }]
                }
            }
        });
    }



    if (chBar2) {
        new Chart(chBar2, {
            type: 'bar',
            data: {
                labels: labelsorgflm,
                datasets: datasetsorgflm,
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
                    text: 'ORG CHART FLM Engineer Level - Active Employee'
                },
                scales: {
                    xAxes: [{
                        barPercentage: 0.5,
                        categoryPercentage: 0.5
                    }]
                }
            }
        });
    }

    if (chBar3) {
        new Chart(chBar3, {
            type: 'bar',
            data: {
                labels: labelsorgmanagement,
                datasets: datasetsorgmanagement,
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
                    text: 'ORG CHART Management Level - Active Employee'
                },
                scales: {
                    xAxes: [{
                        barPercentage: 1.0,
                        categoryPercentage: 0.9
                    }]
                }
            }
        });
    }
}
</script>
@endpush