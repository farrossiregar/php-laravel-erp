<div>
    <div class="row">
        <div class="col-md-1">                
            <select class="form-control" wire:model="year">
                <option value=""> --- Year --- </option>
                @foreach(\App\Models\SiteListTrackingDetail::select(\DB::raw('YEAR(period) as tahun'))->groupBy('tahun')->get() as $item) 
                <option>{{$item->tahun}}</option>
                @endforeach 
            </select>
        </div>
        {{-- <div class="col-md-2" wire:ignore>
            <select class="multiselect multiselect-custom multiselect_month" style="width:100%;" wire:model="month" multiple="multiple">
                @foreach(\App\Models\SiteListTrackingDetail::select(\DB::raw('MONTH(period) as month'))->groupBy('month')->orderBy('month','ASC')->get() as $item)
                @if(empty($item->month))@continue @endif
                <option value="{{$item->month}}">{{date('F', mktime(0, 0, 0, $item->month, 10))}}</option>
                @endforeach
            </select>
        </div> --}}
        <div class="col-md-1">                
            <select class="form-control" wire:model="region_id">
                <option value=""> -- Region -- </option>
                @foreach($regions as $item) 
                    @if(!isset($item->region_->id)) @continue @endif
                    <option value="{{$item->region_id}}">{{$item->region_->region}}</option>
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
        <table class="table table-striped m-b-0 c_list">
            <thead>
                <tr>
                    <th>Regional - Type</th>
                    <th>Jan</th>
                    <th>Feb</th>
                    <th>Mar</th>
                    <th>Apr</th>
                    <th>May</th>
                    <th>Jun</th>
                    <th>Jul</th>
                    <th>Aug</th>
                    <th>Sep</th>
                    <th>Oct</th>
                    <th>Nov</th>
                    <th>Dec</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                    @if(!isset($item->region_->region)) @continue @endif
                    <tr>
                        <td>{{isset($item->region_->region) ? $item->region_->region ." - ". $item->type : '-'}}</td>
                        @for($bulan=1;$bulan<=12;$bulan++)
                            <td>
                                @php($sum = \App\Models\SiteListTrackingDetail::whereMonth('period',$bulan)->where(['region_id'=>$item->region_id,'type'=>$item->type])->get()->sum('qty_po'))
                                {{isset($sum) ? format_idr($sum) : 0}}
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
        var chBar="";

        $( document ).ready(function() {
            $('.multiselect_month').multiselect({ 
                    nonSelectedText: ' --- All Month --- ',
                    onChange: function (option, checked) {
                        @this.set('month', $('.multiselect_month').val());
                    },
                    buttonWidth: '100%'
                }
            );
            init_chart_sitelisttracking();
        });
        Livewire.on('init-chart',(data)=>{
            console.log(data);
            labels = JSON.parse(data.labels);
            datasets = JSON.parse(data.datasets);
            init_chart_sitelisttracking();
        });
        function init_chart_sitelisttracking(){
            var colors = ['#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];
            if(chBar!=="") chBar.destroy();
                                
            chBar = new Chart(document.getElementById("chBar"), {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: datasets,
                },
                options: {
                    maintainAspectRatio: false,
                    // responsive: true,
                    legend: {
                        // display: true,
                        position:'bottom'
                    },
                    title: {
                        display: true,
                        text: '{{$project_name}}'
                    },
                    scales: {
                        xAxes: [{
                            // barPercentage: 0.4,
                            // categoryPercentage: 0.5
                        }]
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
                                            ctx.fillText(data, bar._model.x, bar._model.y-10);
                                        });
                                    });
                                }
                            },
                }
            });
        }
    </script>
@endpush