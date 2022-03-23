<div>
    <div class="header row">
        <div class="col-md-1">
            <select class="form-control" wire:model="year">
                @foreach(\App\Models\CustomerAssetManagementHistory::select(\DB::raw('YEAR(created_at) as tahun'))->groupBy('tahun')->get() as $item)
                @if(empty($item->tahun))@continue @endif
                <option>{{$item->tahun}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2" wire:ignore>
            <select class="multiselect multiselect-custom multiselect_month" style="width:100%;" wire:model="month" multiple="multiple">
                @foreach(\App\Models\CustomerAssetManagementHistory::select(\DB::raw('MONTH(created_at) as month'))->where(function($table) use ($year){ if($year) $table->whereYear('created_at',$year); })->groupBy('month')->get() as $item)
                @if(empty($item->month))@continue @endif
                <option value="{{$item->month}}">{{date('F', mktime(0, 0, 0, $item->month, 10))}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2" wire:ignore>
            <select class="multiselect multiselect-custom multiselect_region" wire:model="region" multiple="multiple">
                @foreach(\App\Models\CustomerAssetManagementHistory::groupBy('region_name')->get() as $item)
                @if(empty($item->region_name))@continue @endif
                <option>{{$item->region_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select class="form-control" wire:model="region_cluster_id">
                <option value=""> -- Cluster --</option>
                @foreach(\App\Models\CustomerAssetManagementHistory::whereNotNull('region_cluster_id')->groupBy('region_cluster_id')->get() as $item)
                    @if(!isset($item->cluster->name))@continue @endif
                    <option value="{{$item->region_cluster_id}}">{{$item->cluster->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2 pt-1">
            <label class="mb-0" wire:loading>
                <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                <span class="sr-only">{{ __('Loading...') }}</span>
            </label>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9">
            <div class="body p-0" style="height:400px;">
                <canvas id="stolen-chart" style="height:400px;"></canvas>
            </div>
        </div>
        <div class="col-md-3">
            <div class="body p-0">
                <canvas id="stolen-pie" style="height:400px;"></canvas>
            </div>
        </div>
    </div>
    @push('after-scripts')
        <script>
            var labels = {!!$labels!!};
            var datasets = {!!$datasets!!};

            var labels_stolen = {!!$labels_stolen!!};
            var datasets_stolen = {!!$datasets_stolen!!};

            var labels_pie = {!!$labels_pie!!};
            var datasets_pie = {!!$datasets_pie!!};

            var chartStolen = "";
            var pieStolen = "";
            var chart="";

            // $( document ).ready(function() {
                init_chart_stolen();
                init_pie_chart();
                $('.multiselect_region').multiselect({ 
                        nonSelectedText: ' --- All Region --- ',
                        onChange: function (option, checked) {
                            @this.set('region', $('.multiselect_region').val());
                        },
                        buttonWidth: '100%'
                    }
                );
                $('.multiselect_month').multiselect({ 
                        nonSelectedText: ' --- All Month --- ',
                        onChange: function (option, checked) {
                            @this.set('month', $('.multiselect_month').val());
                        },
                        buttonWidth: '100%'
                    }
                );
            // });

            Livewire.on('init-chart-stolen',(data)=>{
                labels_stolen = JSON.parse(data.labels_stolen);
                datasets_stolen = JSON.parse(data.datasets_stolen);

                labels_pie = JSON.parse(data.labels_pie);
                datasets_pie = JSON.parse(data.datasets_pie);
                init_chart_stolen();
                init_pie_chart();

                console.log('chart');
                console.log(data);
            });

            function init_pie_chart()
            {
                var pieOptions = {
                        events: false,
                        maintainAspectRatio: false,
                        animation: {
                            duration: 500,
                            easing: "easeOutQuart",
                            onComplete: function () {
                            var ctx = this.chart.ctx;
                            ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontFamily, 'normal', Chart.defaults.global.defaultFontFamily);
                            ctx.textAlign = 'center';
                            ctx.textBaseline = 'bottom';

                            this.data.datasets.forEach(function (dataset) {

                                for (var i = 0; i < dataset.data.length; i++) {
                                var model = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._model,
                                    total = dataset._meta[Object.keys(dataset._meta)[0]].total,
                                    mid_radius = model.innerRadius + (model.outerRadius - model.innerRadius)/2,
                                    start_angle = model.startAngle,
                                    end_angle = model.endAngle,
                                    mid_angle = start_angle + (end_angle - start_angle)/2;

                                var x = mid_radius * Math.cos(mid_angle);
                                var y = mid_radius * Math.sin(mid_angle);

                                ctx.fillStyle = '#fff';
                                if (i == 3){ // Darker text color for lighter background
                                    ctx.fillStyle = '#444';
                                }
                                var percent = String(Math.round(dataset.data[i]/total*100)) + "%";
                                ctx.fillText(percent, model.x + x, model.y + y + 15);
                                }
                            });               
                            }
                        }
                    };

                if(pieStolen!=="") pieStolen.destroy();
                var colors = ['#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];
                pieStolen = document.getElementById("stolen-pie");
                                
                pieStolen = new Chart(pieStolen, {
                        type: 'pie',
                        data: {
                            labels: labels_pie,
                            datasets: datasets_pie,
                        },
                        options : pieOptions 
                    });
            }

            function init_chart_stolen(){
                if(chartStolen!=="") chartStolen.destroy();
                var colors = ['#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];
                chartStolen = document.getElementById("stolen-chart");
                                
                chartStolen = new Chart(chartStolen, {
                        type: 'bar',
                        data: {
                            labels: labels_stolen,
                            datasets: datasets_stolen,
                        },
                        options: {
                            title: {
                                display:true,
                                text : "STOLEN & NOT STOLEN"
                            },
                            maintainAspectRatio: false,
                            legend: {
                                position: 'bottom',
                            },
                            scales: {
                                y: {
                                    beginAtZero: true
                                },
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
            }

            function init_chart(){
                if(chart!=="") chart.destroy();
                var config = {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: datasets
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
                            text: 'BATTERY CAGE INSTALL'
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
                        },
                        
                    }
                };
                var ctx = document.getElementById('battery-cage-chart').getContext('2d');
                chart = new Chart(ctx, config);
            }
        </script>
    @endpush
</div>