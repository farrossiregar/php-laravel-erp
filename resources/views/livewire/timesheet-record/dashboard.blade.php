<div>
    <div class="row">
        <div class="col-md-1">                
            <select class="form-control" wire:model="year">
                <option value=""> --- Year --- </option>
                @foreach(\App\Models\TeamScheduleNoc::select(DB::Raw('year(start_schedule)'))->groupBy(DB::Raw('year(start_schedule)'))->get() as $item) 
                <option>{{date_format(date_create($item->start_schedule), 'Y')}}</option>
                @endforeach 
            </select>
        </div>

        <div class="col-md-2">                
            <select class="form-control" wire:model="project">
                <option value=""> --- Project --- </option>
                
                @foreach(\App\Models\TeamScheduleNoc::select('project')->orderBy('id', 'desc')
                                ->where('company_name', Session::get('company_id'))
                                ->groupBy('project')
                                ->get() as $item)
                <option value="{{$item->project}}">{{ get_project_company($item->project, Session::get('company_id')) }}</option>
                @endforeach
                
            </select>
        </div>

        <div class="col-md-2">                
            <select class="form-control" wire:model="region">
                <option value=""> --- Region --- </option>
                
                @foreach(\App\Models\TeamScheduleNoc::select('region')->orderBy('id', 'desc')
                                                    ->groupBy('region')
                                                    ->get() as $item)
                <option value="{{$item->region}}">{{$item->region}}</option>
                @endforeach
                
            </select>
        </div>

        <!-- <div class="col-md-2">                
            <select class="form-control" wire:model="company_name">
                <option value=""> --- Company Name --- </option>
                
                <option value="1">HUP</option>
                <option value="2">PMT</option>
                
            </select>
        </div> -->
        
       
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
</div>
@push('after-scripts')
<script src="{{ asset('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
<script src="{{ asset('assets/vendor/chartjs/Chart.bundle.min.js') }}?v=2"></script>

<script>
var labels = {!!$labels!!};
var datasets = {!!$datasets!!};
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
    init_chart_databasenoc();
});
function init_chart_databasenoc(){
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
                    text: 'PERSONEL OVERTIME - MONTHLY'
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