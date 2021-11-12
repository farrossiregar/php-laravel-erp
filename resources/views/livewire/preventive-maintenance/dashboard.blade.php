<div>
    <div class="row mb-3">
        <div class="col-md-2">
            <input type="text" class="form-control date_range" placeholder="Date" />
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
            <h6>Submitted</h6>
            <h1>{{$total_submitted}}</h1>
            <h6>Approved EID</h6>
            <h1>{{$total_approved_eid}}</h1>
            <hr />
            <h6>{{floor(($total_pm / $total_submitted) * 100)}}% Submitted</h6>
            <h6>{{floor(($total_submitted / $total_approved_eid) * 100)}}% Approved EID</h6>   
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
                    <th colspan="4">Monthly Regional Update</th>
                    <th rowspan="2" class="text-center">Daily Achievement %</th>
                    <th rowspan="2" class="text-center">Monthly Achievement %</th>
                </tr>
                <tr style="background:#eee;" class="text-center">
                    <th>Open</th>
                    <th>In Progress</th>
                    <th>Submitted</th>
                    <th>Approved IED</th>
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
                        <td class="text-center">{{$item->submitted}}</td>
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
        @push('after-scripts')
            <script>
                $('.date_range').daterangepicker({
                    opens: 'left',
                    locale: {
                        cancelLabel: 'Clear'
                    },
                    autoUpdateInput: false,
                });
                $('.date_range').on('apply.daterangepicker', function(ev, picker) {
                    $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));

                    @this.set("date_start", picker.startDate.format('YYYY-MM-DD'));
                    @this.set("date_end", picker.endDate.format('YYYY-MM-DD'));
                });
                $('.date_range').on('cancel.daterangepicker', function(ev, picker) {
                    $(this).val('');
                });
            </script>
        @endpush
    </div>
    @push('after-scripts')
        <script src="{{ asset('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
        <script src="{{ asset('assets/vendor/chartjs/Chart.bundle.min.js') }}?v=2"></script>
        <script>
            var labels = {!!$labels!!};
            var series = {!!$series!!};
            const data = {
                labels: labels,
                datasets: series
            };

            const config = {
                type: 'horizontalBar',
                data: data,
                options: {
                    maintainAspectRatio: false,
                    indexAxis: 'y',
                    // Elements options apply to all of the options unless overridden in a dataset
                    // In this case, we are setting the border of each horizontal bar to be 2px wide
                    elements: {
                        bar: {
                            borderWidth: 2,
                        }
                    },
                    // responsive: true,
                    plugins: {
                    legend: {
                        position: 'right',
                    },
                    title: {
                        display: true,
                        text: 'Chart.js Horizontal Bar Chart'
                    }
                    }
                },
            };

            var chart="";
            var ctx = document.getElementById('chart').getContext('2d');
            chart = new Chart(ctx, config);
        </script>
    @endpush
</div>