<div>
    <div class="row">
        <div class="col-md-1">                
            <select class="form-control" wire:model="year">
                @foreach(\App\Models\DutyrosterSitelistDetail::select(\DB::raw('YEAR(created_at) as  year'))->groupBy('year')->get() as $item) 
                <option>{{$item->year}}</option>
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
    <div class="table-responsive">
        <table class="table table-striped">
            <thead> 
                <tr>
                    <th>Project</th>
                    @for($bulan=1;$bulan<=12;$bulan++)
                        <th class="text-center">{{date('F', mktime(0, 0, 0, $bulan, 10))}}</th>         
                    @endfor
                </tr>
            </thead>
            <tbody>
                @foreach($projects as $project)
                    <tr>
                        <td>{{$project->project}}</td>
                        @for($bulan=1;$bulan<=12;$bulan++)
                            <td class="text-center">
                                @php($count = \App\Models\DutyrosterSitelistDetail::where('remarks', '<>', '1')
                                                    ->whereMonth('created_at',$bulan)
                                                    ->whereYear('created_at',$this->year)
                                                    ->where('project',$project->project)
                                                    ->get()->count())
                                {{$count?$count:0}}
                            </td>         
                        @endfor
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@push('after-scripts')
<script src="{{ asset('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
<script src="{{ asset('assets/vendor/chartjs/Chart.bundle.min.js') }}?v=2"></script>
<script>
var labels = {!!$labels!!};
var datasets = {!!$datasets!!};

$( document ).ready(function() {
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
                    text: 'DUTY ROSTER MONTHLY - SITE PER PROJECT'
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
}
</script>
@endpush