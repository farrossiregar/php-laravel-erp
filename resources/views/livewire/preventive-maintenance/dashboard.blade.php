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
    {{-- <div>
        <canvas id="chart" style="height:400px;"></canvas>
    </div> --}}
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
                    <tr>
                        <td>{{isset($item->region->region) ? $item->region->region : ''}}</td>
                        <td>{{isset($item->sub_region->name) ? $item->sub_region->name : ''}}</td>
                        <td>{{$item->site_type}}</td>
                        <td>{{$item->pm_type}}</td>
                        <td class="text-center">{{$item->sow}}</td>
                        <td class="text-center">{{$item->daily}}</td>
                        <td class="text-center">{{$item->open}}</td>
                        <td class="text-center">{{$item->in_progress}}</td>
                        <td class="text-center">{{$item->submitted}}</td>
                        <td class="text-center">0</td>
                        <td class="text-center">
                            @if(!empty($item->daily) and !empty($item->submitted))
                                {{@floor(($item->submitted/$item->daily)*100)}}%
                            @else 
                                0%
                            @endif
                        </td>
                        <td class="text-center">
                            @if($item->sow and $item->total_submitted)
                                {{@floor(($item->total_submitted / $item->sow)*100)}}%
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
            const labels = ['Januari','Februari','Maret','April','Mei','Juni'];
            const data = {
                labels: labels,
                datasets: [
                    {
                        label: 'Dataset 1',
                        data: [10,20,30,40],
                        borderColor: "rgb(255, 99, 132)",
                        backgroundColor: "rgb(255, 99, 132)"//Utils.transparentize(Utils.CHART_COLORS.red, 0.5),
                    },
                    {
                        label: 'Dataset 2',
                        data: [15,25,35,45],
                        borderColor: 'rgb(54, 162, 235)',
                        backgroundColor: 'rgb(54, 162, 235)',
                    }
                ]
            };

            const config = {
                type: 'bar',
                data: data,
                options: {
                    indexAxis: 'y',
                    // Elements options apply to all of the options unless overridden in a dataset
                    // In this case, we are setting the border of each horizontal bar to be 2px wide
                    elements: {
                    bar: {
                        borderWidth: 2,
                    }
                    },
                    responsive: true,
                    plugins: {
                    legend: {
                        position: 'left',
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