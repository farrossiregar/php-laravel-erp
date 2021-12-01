<div>
    <div class="row mb-3">
        <div class="col-md-1" wire:ignore wire:model="year">
            <select class="form-control">
                <option value=""> -- Year -- </option>
                @foreach ($years as $item)
                    <option>{{$item->tahun}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-1" wire:ignore wire:model="month">
            <select class="form-control">
                <option value=""> -- Month -- </option>
                @foreach ($months as $item)
                    <option>{{$item->bulan}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2" wire:ignore>
            <select class="form-control" wire:model="sub_region_id">
                <option value=""> -- Sub Region -- </option>
                @foreach($sub_region as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
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
    <div class="row">
        <div class="col-md-10">
            <canvas id="chart" style="height:400px;"></canvas>
        </div>
        <div class="col-md-2 text-center">
            <h6>Summary SOW (Monthly Target)</h6>
            <hr />
            <h6>SOW (Monthly Target)</h6>
            <h1>{{format_idr($total_sow)}}</h1>
            <h6>Submitted</h6>
            <h1>{{$total_submitted}}</h1>
            <h6>Approved EID</h6>
            <h1>{{$total_approved_eid}}</h1>
            <hr />
            <h6>
                @if($total_sow and $total_submitted)
                    {{round((($total_submitted/$total_sow) * 100),1)}}%
                @else
                    0%
                @endif 
                Submitted
            </h6>
            <h6>
                @if($total_sow and $total_approved_eid)
                    {{round(($total_approved_eid / $total_sow) * 100,1)}}% 
                @else
                    0%
                @endif
                Approved EID
            </h6>   
        </div>
    </div>
    <div class="table-responsive">
        <table class="table m-b-0 c_list">
            <thead>
                <tr style="background:#eee;">
                    <th rowspan="2">Region</th>
                    <th rowspan="2">Sub Region</th>   
                    <th rowspan="2">Site Type</th>   
                    <th rowspan="2">PM Type</th>   
                    <th rowspan="2">SOW ( Monthly Target )</th>
                    <th rowspan="2">Daily Target</th>
                    <th colspan="4" class="text-center">Monthly Regional Update</th>
                    <th rowspan="2" class="text-center">Daily Achievement %</th>
                    <th rowspan="2" class="text-center">Monthly Achievement %</th>
                </tr>
                <tr style="background:#eee;" class="text-center">
                    <th>Open</th>
                    <th>In Progress</th>
                    <th>Submitted</th>
                    <th>Approved EID</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                    @if(!isset($item->region->region)) @continue @endif
                    @php($sow = get_setting_sow($item))
                    @php($daily_target=floor($sow / 24))
                    <tr>
                        <td>{{isset($item->region->region) ? $item->region->region : ''}}</td>
                        <td>{{isset($item->sub_region->name) ? $item->sub_region->name : ''}}</td>
                        <td>{{$item->site_type}}</td>
                        <td>{{$item->pm_type}}</td>
                        <td class="text-center">{{$sow}}</td>
                        <td class="text-center">{{$daily_target}}</td>
                        <td class="text-center">{{$item->open}}</td>
                        <td class="text-center">{{$item->in_progress}}</td>
                        <td class="text-center">{{$item->total_submitted}}</td>
                        <td class="text-center">{{$item->approved_ied}}</td>
                        <td class="text-center">
                            @if(!empty($daily_target) and !empty($item->submitted))
                                {{@floor(($item->submitted/$daily_target)*100)}}%
                            @else 
                                0%
                            @endif
                        </td>
                        <td class="text-center">
                            @if($sow and $item->total_submitted)
                                {{@floor(($item->total_submitted / $sow)*100)}}%
                            @else 
                                0%
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @push('after-scripts')
        <script src="{{ asset('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
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
                console.log(data);
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
                        // // responsive: true,
                        // plugins: {
                        //     legend: {
                        //         position: 'right',
                        //     },
                        //     title: {
                        //         display: true,
                        //         text: 'Chart.js Horizontal Bar Chart'
                        //     },
                        //     datalabels: {
                        //         color: 'black',
                        //         display: function(context) {
                        //             return context.dataset.data[context.dataIndex] > 15;
                        //         },
                        //         font: {
                        //             weight: 'bold'
                        //         },
                        //         formatter: Math.round
                        //     }
                        // }

                        responsive: true,
                        legend: {
                            position: 'top',
                            // display: true,
            
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

                                // ctx.textBaseline = 'bottom';
                                ctx.position = 'chartArea'

                                this.data.datasets.forEach(function(dataset, i) {
                                    var meta = chartInstance.controller.getDatasetMeta(i);
                                    meta.data.forEach(function(bar, index) {
                                        var data = dataset.data[index];
                                        ctx.fillText(data, bar._model.x+10, bar._model.y);
                                    });
                                });
                            }
                        },
                        // title: {
                        //     // display: false,
                        //     // text: ''
                        // },
                    }
                };

                var ctx = document.getElementById('chart').getContext('2d');
                chart = new Chart(ctx, config);
            }
            
        </script>
    @endpush
</div>