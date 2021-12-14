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
        <div class="col-md-1">                
            <select class="form-control" wire:model="type">
                <option value=""> --- Type --- </option>
                
                <option value="1">Tools NOC</option>
                <option value="2">Escalation Record</option>
                
            </select>
        </div>
        
        <div class="col-md-4">
            @if($this->type == '1')
            <label><h4>Database Tools NOC</h4></label>
            @endif

            @if($this->type == '2')
            <label><h4>Escalation Record</h4></label>
            @endif
        </div>
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