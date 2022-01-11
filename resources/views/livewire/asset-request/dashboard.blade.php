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

        <div class="col-md-2">                
            <select class="form-control" wire:model="region">
                <option value=""> --- Region --- </option>
                @foreach(\App\Models\Region::orderBy('id', 'desc')
                                ->get() as $item)
                <option value="{{ $item->id }}">{{ $item->region_code }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2">                
            <select class="form-control" wire:model="project">
                <option value=""> --- Project --- </option>
                @foreach($dataproject as $item)
                <option value="{{ $item->name }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <br>
    <div class="row">
        <div class="col-md-2">
            <div class="card overflowhidden number-chart" style="background-color: #fac091;">
                <div class="body">
                    <div class="number">
                        <h6>Asset Request Aging</h6>
                        <span id="aging"></span>
                    </div>
                    <small class="text-muted">Asset Request > 2 Weeks</small>
                </div>
                <!-- <div class="sparkline" data-type="line" data-spot-Radius="0" data-offset="90" data-width="100%" data-height="50px"
                data-line-Width="1" data-line-Color="#fac091" data-fill-Color="#fac091">1,4,2,3,6,2</div> -->
            </div>
        </div>
        <br>
        
        <div class="col-md-3">
            <label wire:loading>
                <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                <span class="sr-only">{{ __('Loading...') }}</span>
            </label>
        </div>
    </div>
    <div class="mt-4" style="height: 300px">
        <canvas id="chBar"></canvas>
    </div>
<!-- 
    <div class="mt-4" style="height: 300px">
        <canvas id="chBar1"></canvas>
    </div> -->
</div>
@push('after-scripts')
<script src="{{ asset('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
<script src="{{ asset('assets/vendor/chartjs/Chart.bundle.min.js') }}?v=2"></script>

<script>
var labels = {!!$labels!!};
var datasets = {!!$datasets!!};
var aging = {!!$aging!!};

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
    aging = data.aging;
    $('#aging').html(aging);
    // console.log(aging);

    
    
    init_chart_databasenoc();
});
function init_chart_databasenoc(){
    var colors = ['#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];
    var chBar = document.getElementById("chBar");
    // var chBar1 = document.getElementById("chBar1");
                       
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
                    text: 'REQUEST ASSET - MONTHLY'
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

    // if (chBar1) {
    //     new Chart(chBar1, {
    //         type: 'bar',
    //         data: {
    //             labels: labels,
    //             datasets: datasetsamount,
    //         },
    //         options: {
    //             maintainAspectRatio: false,
    //             responsive: true,
    //             legend: {
    //                 display: true,
    //                 position:'bottom'
    //             },
    //             title: {
    //                 display: true,
    //                 text: 'AMOUNT SPENT - MONTHLY'
    //             },
    //             scales: {
    //                 xAxes: [{
    //                     barPercentage: 0.4,
    //                     categoryPercentage: 0.5
    //                 }]
    //             }
    //         }
    //     });
    // }
}
</script>
@endpush