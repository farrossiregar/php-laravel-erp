@section('title', __('Site Tracking'))
@section('parentPageTitle', 'Home')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header row">
                
                <div class="col-md-1">
                    @if(check_access('cluster.insert'))
                    <a href="{{route('cluster.insert')}}" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Import Site Tracking')}}</a>
                    @endif
                </div>
            </div>
            <div class="body pt-0">

<!--             
                <div class="table-responsive">
                    <table class="table table-striped m-b-0 c_list">
                        <thead>
                            <tr>
                                <th>No</th>                               
                                <th>Date Upload</th>          
                                <th>Upload By</th>          
                                <th>Action</th>  
                            </tr>
                        </thead>
                        <tbody>
                           
                        </tbody>
                    </table>
                </div>
                <br /> -->
                
            </div>



                <div class="container">
                    <div class="row my-3">
                        <div class="col">
                            <h4>NETWORK GROWTH MD EID ISAT</h4>
                        </div>
                    </div>
                    <div class="row my-2">
                        <!-- <div class="col-md-8 py-1">
                            <div class="card">
                                <div class="card-body">
                                    <canvas id="chLine"></canvas>
                                </div>
                            </div>
                        </div> -->
                        <div class="col-md-6 py-1">
                            <div class="card">
                                <div class="card-body">
                                    <canvas id="chBar"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row py-2">
                        <div class="col-md-4 py-1">
                            <div class="card">
                                <div class="card-body">
                                    <canvas id="chDonut1"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 py-1">
                            <div class="card">
                                <div class="card-body">
                                    <canvas id="chDonut2"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 py-1">
                            <div class="card">
                                <div class="card-body">
                                    <canvas id="chDonut3"></canvas>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
                
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="confirm_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-warning"></i> Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Import Data</h4> </div>
                <form method="POST" id="form-upload" enctype="multipart/form-data" class="form-horizontal frm-modal-education" action="route('attendance.import')">
                    
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-md-3">File (xls)</label>
                            <div class="col-md-9">
                                <input type="file" name="file" class="form-control" />
                            </div>
                        </div>
                        <a href="asset('storage/sample/Sample-Attendance.xlsx')"><i class="fa fa-download"></i> Download Sample Excel</a>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect btn-sm" data-dismiss="modal">Close</button>
                        <label class="btn btn-info btn-sm" id="btn_import">Import</label>
                    </div>
                </form>
                <div style="text-align: center;display: none;" class="div-proses-upload">
                    <h3>Uploading !</h3>
                    <h1 class=""><i class="fa fa-spin fa-spinner"></i></h1>
                </div>
        </div>
    </div>
</div>



@section('page-script')
Livewire.on('company-delete-hide',()=>{
    $("#modal_delete").modal('hide');
});

@endsection


<script>
    /* chart.js chart examples */

    // chart colors
    var colors = ['#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];

    /* large line chart */
    var chLine = document.getElementById("chLine");
    var chartData = {
    // labels: ["S", "M", "T", "W", "T", "F", "S"],
    labels: ["NO", "NY SUBMIT", "YES"],
    datasets: [{
        // data: [589, 445, 483, 503, 689, 692, 634],
        data: [589, 445, 483],
        backgroundColor: 'transparent',
        borderColor: colors[0],
        borderWidth: 4,
        pointBackgroundColor: colors[0]
    },
    {
        data: [789, 345, 583],
        backgroundColor: 'transparent',
        borderColor: colors[1],
        borderWidth: 4,
        pointBackgroundColor: colors[1]
    },
    {
        data: [520, 400, 550],
        backgroundColor: 'transparent',
        borderColor: colors[2],
        borderWidth: 4,
        pointBackgroundColor: colors[2]
    }
    //   {
    //     data: [639, 465, 493, 478, 589, 632, 674],
    //     backgroundColor: colors[3],
    //     borderColor: colors[1],
    //     borderWidth: 4,
    //     pointBackgroundColor: colors[1]
    //   }
    ]
    };
    if (chLine) {
    new Chart(chLine, {
    type: 'line',
    data: chartData,
    options: {
        scales: {
        xAxes: [{
            ticks: {
            beginAtZero: false
            }
        }]
        },
        legend: {
        display: false
        },
        responsive: true
    }
    });
    }

    /* large pie/donut chart */
    var chPie = document.getElementById("chPie");
    if (chPie) {
    new Chart(chPie, {
        type: 'pie',
        data: {
        labels: ['Desktop', 'Phone', 'Tablet', 'Unknown'],
        datasets: [
            {
            backgroundColor: [colors[1],colors[0],colors[2],colors[5]],
            borderWidth: 0,
            data: [50, 40, 15, 5]
            }
        ]
        },
        plugins: [{
        beforeDraw: function(chart) {
            var width = chart.chart.width,
                height = chart.chart.height,
                ctx = chart.chart.ctx;
            ctx.restore();
            var fontSize = (height / 70).toFixed(2);
            ctx.font = fontSize + "em sans-serif";
            ctx.textBaseline = "middle";
            var text = chart.config.data.datasets[0].data[0] + "%",
                textX = Math.round((width - ctx.measureText(text).width) / 2),
                textY = height / 2;
            ctx.fillText(text, textX, textY);
            ctx.save();
        }
        }],
        options: {layout:{padding:0}, legend:{display:false}, cutoutPercentage: 80}
    });
    }

    /* bar chart */
    var chBar = document.getElementById("chBar");
    if (chBar) {
    new Chart(chBar, {
    type: 'bar',
    data: {
        labels: ["S", "M", "T", "W", "T", "F", "S"],
        datasets: [{
        data: [589, 445, 483, 503, 689, 692, 634],
        backgroundColor: colors[0]
        },
        {
        data: [639, 465, 493, 478, 589, 632, 674],
        backgroundColor: colors[1]
        }]
    },
    options: {
        legend: {
        display: false
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

    /* 3 donut charts */
    var donutOptions = {
    cutoutPercentage: 85, 
    legend: {position:'bottom', padding:5, labels: {pointStyle:'circle', usePointStyle:true}}
    };

    // donut 1
    var chDonutData1 = {
        labels: ['Bootstrap', 'Popper', 'Other'],
        datasets: [
        {
            backgroundColor: colors.slice(0,3),
            borderWidth: 0,
            data: [74, 11, 40]
        }
        ]
    };

    var chDonut1 = document.getElementById("chDonut1");
    if (chDonut1) {
    new Chart(chDonut1, {
        type: 'pie',
        data: chDonutData1,
        options: donutOptions
    });
    }

    // donut 2
    var chDonutData2 = {
        labels: ['Wips', 'Pops', 'Dags'],
        datasets: [
        {
            backgroundColor: colors.slice(0,3),
            borderWidth: 0,
            data: [40, 45, 30]
        }
        ]
    };
    var chDonut2 = document.getElementById("chDonut2");
    if (chDonut2) {
    new Chart(chDonut2, {
        type: 'pie',
        data: chDonutData2,
        options: donutOptions
    });
    }

    // donut 3
    var chDonutData3 = {
        labels: ['Angular', 'React', 'Other'],
        datasets: [
        {
            backgroundColor: colors.slice(0,3),
            borderWidth: 0,
            data: [21, 45, 55, 33]
        }
        ]
    };
    var chDonut3 = document.getElementById("chDonut3");
    if (chDonut3) {
    new Chart(chDonut3, {
        type: 'pie',
        data: chDonutData3,
        options: donutOptions
    });
    }

    /* 3 line charts */
    var lineOptions = {
        legend:{display:false},
        tooltips:{interest:false,bodyFontSize:11,titleFontSize:11},
        scales:{
            xAxes:[
                {
                    ticks:{
                        display:false
                    },
                    gridLines: {
                        display:false,
                        drawBorder:false
                    }
                }
            ],
            yAxes:[{display:false}]
        },
        layout: {
            padding: {
                left: 6,
                right: 6,
                top: 4,
                bottom: 6
            }
        }
    };

    var chLine1 = document.getElementById("chLine1");
    if (chLine1) {
    new Chart(chLine1, {
        type: 'line',
        data: {
            labels: ['Jan','Feb','Mar','Apr','May'],
            datasets: [
                {
                backgroundColor:'#ffffff',
                borderColor:'#ffffff',
                data: [10, 11, 4, 11, 4],
                fill: false
                }
            ]
        },
        options: lineOptions
    });
    }
    var chLine2 = document.getElementById("chLine2");
    if (chLine2) {
    new Chart(chLine2, {
        type: 'line',
        data: {
            labels: ['A','B','C','D','E'],
            datasets: [
                {
                backgroundColor:'#ffffff',
                borderColor:'#ffffff',
                data: [4, 5, 7, 13, 12],
                fill: false
                }
            ]
        },
        options: lineOptions
    });
    }

    var chLine3 = document.getElementById("chLine3");
    if (chLine3) {
    new Chart(chLine3, {
        type: 'line',
        data: {
            labels: ['Pos','Neg','Nue','Other','Unknown'],
            datasets: [
                {
                backgroundColor:'#ffffff',
                borderColor:'#ffffff',
                data: [13, 15, 10, 9, 14],
                fill: false
                }
            ]
        },
        options: lineOptions
    });
    }
</script>

@if(check_access('cluster.delete'))
<div class="modal fade" id="modal_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <livewire:cluster.delete />
    </div>
</div>
@endif
@section('page-script')
@if(check_access('cluster.delete'))
Livewire.on('emit-delete-hide',()=>{
    $("#modal_delete").modal('hide');
});
@endif
@endsection