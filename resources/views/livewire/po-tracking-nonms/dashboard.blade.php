<div class="body pt-0 px-0">    
    <div class="row">
        <div class="col-md-7">
            <canvas id="chart-bar" style="height:400px;"></canvas>     
        </div>
        <div class="col-md-5">
            <canvas id="chart-pie" style="height:400px;"></canvas>     
        </div>
    </div>
    <div class="row">
        <div class="table-responsive col-md-6">
            <table class="table table-striped m-b-0 c_list table-nowrap-th">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Milestone</th>
                        <th class="text-right">PO Value ( IDR )</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Waiting PR Submission</td>
                        <td class="text-right">{{format_idr($waiting_pr_submission)}}</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>PMG Review</td>
                        <td class="text-right">{{format_idr($pmg_review)}}</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Finance In Review</td>
                        <td class="text-right">{{format_idr($finance_in_review)}}</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Budget Transferred To Project Admin/Finance</td>
                        <td class="text-right">{{format_idr($budget_transfered)}}</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Pending Assignment To Field Team</td>
                        <td class="text-right">{{format_idr($pending_assign)}}</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>On-Going Execution</td>
                        <td class="text-right">{{format_idr($on_going)}}</td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Field Team Submitted</td>
                        <td class="text-right">{{format_idr($field_team_submitted)}}</td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>BAST Regional</td>
                        <td class="text-right">{{format_idr($bast_regional)}}</td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>BAST E2E</td>
                        <td class="text-right">{{format_idr($bast_e2e)}}</td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>Finance To Invoice</td>
                        <td class="text-right">{{format_idr($finance_to_invoice)}}</td>
                    </tr>
                    <tr>
                        <td>11</td>
                        <td>Invoiced</td>
                        <td class="text-right">{{format_idr($invoiced)}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="table-responsive col-md-6">
            <table class="table table-striped m-b-0 c_list table-nowrap-th">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>PO/WO Aging</th>
                        <th class="text-right">PO/WO Count</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>< 30 days</td>
                        <td class="text-right">{{format_idr($days_30)}}</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>30-55 days</td>
                        <td class="text-right">{{format_idr($days_3055)}}</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>>55-120 days</td>
                        <td class="text-right">{{format_idr($days_55120)}}</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>>120-180 days</td>
                        <td class="text-right">{{format_idr($days_120180)}}</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>>180-360 days</td>
                        <td class="text-right">{{format_idr($days_180360)}}</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>>360 days</td>
                        <td class="text-right">{{format_idr($days_360)}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@push('after-scripts')
    <script src="{{ asset('assets/vendor/chartjs/Chart.bundle.min.js') }}?v=2"></script>
    <script>
        var config = {
            type: 'bar',
            data: {
                labels: ['Waiting PR Submission','PMG Review','Finance In Review','Budget Transf To Project Admin/Finance','Pending Assignment To Field Team','On-Going Execution','Field Team Submitted','BAST Regional','BAST E2E','Finance To Invoice','Invoiced'],
                datasets: [
                    {
                        label : 'Mailstone',
                        data : [{{$waiting_pr_submission}},{{$pmg_review}},{{$finance_in_review}},{{$budget_transfered}},{{$pending_assign}},{{$on_going}},{{$field_team_submitted}},{{$bast_regional}},{{$bast_e2e}},{{$finance_to_invoice}},{{$invoiced}}],
                        backgroundColor: ['#FF0000', '#FF3333', '#FF6666', '#FF9999', '#FFCCCC','#FFE5CC','#E5FFCC','#CCFFCC','#99FF99','#66FF66','#33FF33'],
                    }
                ]
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
                    text: 'Milestone'
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            return Number(tooltipItem.yLabel).toFixed(0).replace(/./g, function(c, i, a) {
                                return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;
                            });
                        }
                    }
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
                            labelString: 'Milestone'
                        },
                        ticks: {
                            autoSkip: false,
                            maxRotation: 90,
                            minRotation: 90,
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            callback: function(value, index, values) {
                                if(parseInt(value) >= 1000){
                                    return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                } else {
                                    return value;
                                }
                            }
                        }
                    }]
                }
            }
        };
        var ctx = document.getElementById('chart-bar').getContext('2d');
        chart = new Chart(ctx, config);

        // pie chart
        const labels_pie = ['< 30 days', '30-55 days', '55-120 days', '120-180 days', '180-360 days','360 days'];
        const data_pie = {
            labels: labels_pie,
            datasets: [
                {
                    label: 'PO/WO Count',
                    data: [{{$days_30}},{{$days_3055}},{{$days_55120}},{{$days_120180}},{{$days_180360}},{{$days_360}}],
                    backgroundColor: [
                        '#33FF33', '#66FF66', '#99FF99', '#CCFFCC', '#FF6666','#FF0000'
                    ]
                }
            ]
        };
        const config_pie = {
            type: 'horizontalBar',
            data: data_pie,
            options: {
                indexAxis: 'y',
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right',
                    },
                    title: {
                        display: true,
                        text: 'PO/WO Aging'
                    }
                }
            },
        };

        var ctx = document.getElementById('chart-pie').getContext('2d');
        chart = new Chart(ctx, config_pie);
    </script>
@endpush