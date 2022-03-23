<div>
    <div class="header row">
        <div class="col-md-1">
            <select class="form-control" wire:model="year">
                @foreach(\App\Models\WorkFlowManagement::select(\DB::raw('YEAR(date) as tahun'))->groupBy('tahun')->get() as $item)
                <option>{{$item->tahun}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2" wire:ignore>
            <select class="multiselect multiselect-custom multiselect_region" style="width:100%;" wire:model="region" multiple="multiple">
                @foreach(\App\Models\WorkFlowManagement::groupBy('region')->get() as $item)
                @if(empty($item->region))@continue @endif
                <option>{{$item->region}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2" wire:ignore>
            <select class="multiselect multiselect-custom multiselect_month" style="width:100%;" wire:model="month" multiple="multiple">
                @foreach(\App\Models\WorkFlowManagement::select(\DB::raw('MONTH(date) as month'))->groupBy('month')->get() as $item)
                @if(empty($item->month))@continue @endif
                <option value="{{$item->month}}">{{date('F', mktime(0, 0, 0, $item->month, 10))}}</option>
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
    <div class="body p-0" style="height:400px;">
        <canvas id="chart-4" style="height:400px;"></canvas>
    </div>
    @push('after-scripts')
        <script>
            $( document ).ready(function() {
                setTimeout(function(){
                    var labels = {!!$labels!!};
                    var series = {!!$series!!};
                    init_chart_total_ft_never_close_manual(labels,series);
                },1000);
            });
            var chart_4="";
            Livewire.on('chart-total-ft-never-close-manual',(data)=>{
                labels = JSON.parse(data.labels);
                series = JSON.parse(data.series);
                init_chart_total_ft_never_close_manual(labels,series);
                console.log('reload chart');
            });
            function init_chart_total_ft_never_close_manual(labels,series){
                if(chart_4!=="") chart_4.destroy();
                var config = {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: series
                    },
                    options: {
                        maintainAspectRatio: false,
                        elements: {
                            line: {
                                tension: 0.000001
                            }
                        },
                        legend: {
                                    position: 'bottom',
                                },
                        responsive: true,
                        title: {
                            display: true,
                            text: 'Total FT Never Close Manual'
                        },
                        tooltips: {
                            mode: 'index',
                            intersect: false,
                        },
                        hover: {
                            mode: 'nearest',
                            intersect: true
                        },
                        scales: {
                            xAxes: [{
                                display: true,
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Date'
                                }
                            }],
                            yAxes: [{
                                display: true,
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Value'
                                }
                            }]
                        }
                    }
                };
                var ctx = document.getElementById('chart-4').getContext('2d');
                chart_4 = new Chart(ctx, config);
            }
        </script>
    @endpush

</div>
