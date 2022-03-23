<div>
    <div class="row mb-3">
        <div class="col-md-1" wire:ignore wire:model="filter_tahun">
            <select class="form-control">
                <option value="">-- Tahun --</option>
                @foreach ($tahun as $item)
                    @if(empty($item->tahun)) @continue @endif
                    <option>{{$item->tahun}}</option>
                @endforeach
            </select>
        </div>
        <div>
            <span wire:loading>
                <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                <span class="sr-only">{{ __('Loading...') }}</span>
            </span>
        </div>
    </div>
    <div>
        <canvas id="chart" style="height:400px;"></canvas>
    </div>
    <div class="table-responsive">
        <table class="table m-b-0 c_list table-bordered">
            <thead>
                <tr>
                    <th class="text-center">Total Team</th>
                    <th class="text-center">Done Drug Test</th>
                    <th class="text-center">% Done Drug Test</th>
                    <th class="text-center">Not Yet Drug Test</th>
                    <th class="text-center">Negative</th>
                    <th class="text-center">Positive</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">{{$total_team}}</td>
                    <td class="text-center">{{$done_drug_test}}</td>
                    <td class="text-center">{{@floor($done_drug_test/$total_team *100)}}%</td>
                    <td class="text-center">{{$total_team-$done_drug_test}}</td>
                    <td class="text-center">{{$negative}}</td>
                    <td class="text-center">{{$positive}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    @push('after-scripts')
        <script src="{{ asset('assets/vendor/chartjs/Chart.bundle.min.js') }}?v=2"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
        <script>
            var chart = "";
            var labels = {!!$labels!!};
            var series = {!!$series!!};
            var data = {
                labels: labels,
                datasets: series
            };

            chart_(data);

            Livewire.on('init-chart',(data)=>{
                labels = JSON.parse(data.labels);
                series = JSON.parse(data.series);
                
                var data = {
                    labels: labels,
                    datasets: series
                };
                chart_(data);
            });

            function chart_(data){
                if(chart!=="") chart.destroy();
                
                const config = {
                    type: 'horizontalBar',
                    data: data,
                    options: {
                        maintainAspectRatio: false,
                        indexAxis: 'y',
                        elements: {
                            bar: {
                                borderWidth: 2,
                            }
                        },
                        // responsive: true,
                        legend: {
                            position: 'top'
                        },
                        "hover": {
                            "animationDuration": 0
                        },
                        "animation": {
                            "duration": 1,
                            "onComplete": function() {
                                var chartInstance = this.chart,
                                ctx = chartInstance.ctx;
                
                                ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                                ctx.textAlign = 'center';
                                ctx.position = 'chartArea'

                                this.data.datasets.forEach(function(dataset, i) {
                                    var meta = chartInstance.controller.getDatasetMeta(i);
                                    meta.data.forEach(function(bar, index) {
                                        var data = dataset.data[index];
                                        ctx.fillText(data, bar._model.x+20, bar._model.y);
                                    });
                                });
                            }
                        },
                    }
                };

                var ctx = document.getElementById('chart').getContext('2d');
                chart = new Chart(ctx, config);
            }
            
        </script>
    @endpush
</div>