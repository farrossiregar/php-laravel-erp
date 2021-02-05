@section('title', __('Critical Case Dashboard'))
@section('parentPageTitle', 'Home')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header row">
                <div class="row my-3">
                    <div class="col">
                        <h4>EMERGENCY TREND - SUMATERA & CWJ</h4>
                    </div>
                </div>

            </div>

            <div class="body pt-0">
                <div class="row my-2">
                    <div class="col-md-3">
                        <h5>Project</h5>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="cxm" value="01" value="m01">
                            <label class="form-check-label" for="flexCheckDefault">
                                lsat
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="cxm" value="02" value="m02">
                            <label class="form-check-label" for="flexCheckDefault">
                                XL
                            </label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h5>Region</h5>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="cxm" value="Sumatera" wire:model="region">
                            <label class="form-check-label" for="flexCheckDefault">
                                Sumatera
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="cxm" value="CWJ" wire:model="region">
                            <label class="form-check-label" for="flexCheckDefault">
                                CWJ
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="cxm" value="Jabo" wire:model="region">
                            <label class="form-check-label" for="flexCheckDefault">
                                Jabo
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="cxm" value="WJ" wire:model="region">
                            <label class="form-check-label" for="flexCheckDefault">
                                WJ
                            </label>
                        </div>
                    </div>
                   
                </div>
                <br>
                <div class="row my-2">
                    <div class="col-md-3">
                        <input type="date" id="filter_start" name="filter_start" wire:model="start" class="form-control datepicker" id="from" placeholder="Start Date" autocomplete="off" />
                        
                    </div>
                    <div class="col-md-3">
                        <input type="date" id="filter_end" name="filter_end" wire:model="end" class="form-control datepicker" id="from" placeholder="End Date" autocomplete="off" />
                        
                    </div>
                    
                </div>
                <div class="row my-2">
                    <div class="col-md-8 py-1">
                        <div class="card">
                            <div class="card-body">
                                <canvas id="chBar"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>



        </div>
    </div>
</div>





@push('after-scripts')
<script>
var labels = {!!json_encode($labels)!!};
var series = {!!json_encode($series)!!};
var seriess = {!!json_encode($seriess)!!};

console.log(series);
console.log(seriess);

var datacc = [];
for(var i = 0; i < series.length; i++)  {
    datacc.push({
            data: series[i],
            backgroundColor: colors[i],
            borderColor: colors[i],
            borderWidth: 4,
            pointBackgroundColor: colors[0]
        });
}

console.log(datacc);
var region = {!!json_encode($region)!!};



$( document ).ready(function() {
    init_chart_critical_case();
});
Livewire.on('init-chart',(data)=>{
    labels = JSON.parse(data.labels);
    series = JSON.parse(data.series);
    init_chart_critical_case();
});

function init_chart_critical_case(){
    var colors = ['#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];
    var chBar = document.getElementById("chBar");
                       
    if (chBar) {
        new Chart(chBar, {
            type: 'bar',
            data: {
                labels: labels,
                datasets : datacc,
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
}
</script>
@endpush


<script>
    // var colors = ['#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];
    // var chBar = document.getElementById("chBar");
                       
    // if (chBar) {
    //     new Chart(chBar, {
    //         type: 'bar',
    //         data: {
                
    //             labels: ["S", "M", "T", "W", "T", "F", "S"],
    //             datasets: [{
    //                         data: [445, 483],
    //                         backgroundColor: colors[0],
    //                         borderColor: colors[0],
    //                         borderWidth: 4,
    //                         pointBackgroundColor: colors[0]
    //                     },
    //                     {
    //                         data: [345, 583],
    //                         backgroundColor: colors[1],
    //                         borderColor: colors[1],
    //                         borderWidth: 4,
    //                         pointBackgroundColor: colors[1]
    //                     }
    //             ],
    //         },
    //         options: {
    //             legend: {
    //             display: false
    //             },
    //             scales: {
    //             xAxes: [{
    //                 barPercentage: 0.4,
    //                 categoryPercentage: 0.5
    //             }]
    //             }
    //         }
    //     });
    // }

    // function getsitelisttracking(){
    //     var year        = $('#year').val();
    //     var region      = $('#region').val();
    //     var mth         = [];
    //     $.each($("input[name='cxm']:checked"), function(){
    //         mth.push($(this).val());
    //     });
    //     // console.log(mth);

        

    //     $.ajax({
    //         url: "{{ route('site-tracking.dashboardsitelist') }}", 
    //         type: "POST",
    //         data: {'year' : year, 'month' : mth, 'region' : region, '_token' : $("meta[name='csrf-token']").attr('content')},
    //         dataType: 'json',
    //         success: function(result){

    //             var chBar = document.getElementById("chBar");
                

    //             var dataslt = [];
    //             // var datas = [[123, 456], [789, 987], [185, 223]];
    //             var bulan = [];
                
    //             for(var i = 0; i < result.length; i++)  {
    //                 console.log(result[i]['QTY']);
    //                 dataslt.push({
    //                         data: [result[i]['QTY']],
    //                         backgroundColor: colors[i],
    //                         borderColor: colors[i],
    //                         borderWidth: 4,
    //                         pointBackgroundColor: colors[0]
    //                     });

    //                 bulan.push(result[i]['period']);
    //                 // console.log(datas[i]);
    //             }
    //             // console.log(dataslt);
    //             // console.log({mth});
                
    //             if (chBar) {
    //                 new Chart(chBar, {
    //                     type: 'bar',
    //                     data: {
                            
    //                         labels: bulan,
    //                         // datasets: [{
    //                         //             data: [445, 483],
    //                         //             backgroundColor: colors[0],
    //                         //             borderColor: colors[0],
    //                         //             borderWidth: 4,
    //                         //             pointBackgroundColor: colors[0]
    //                         //         },
    //                         //         {
    //                         //             data: [345, 583],
    //                         //             backgroundColor: colors[1],
    //                         //             borderColor: colors[1],
    //                         //             borderWidth: 4,
    //                         //             pointBackgroundColor: colors[1]
    //                         //         }
    //                         // ],
    //                         datasets : dataslt,
    //                     },
    //                     options: {
    //                         legend: {
    //                         display: false
    //                         },
    //                         scales: {
    //                         xAxes: [{
    //                             barPercentage: 0.4,
    //                             categoryPercentage: 0.5
    //                         }]
    //                         }
    //                     }
    //                 });
    //             }

    //         }
    //     });

        
    // }

    // $(document).ready(function(){
    //     var year        = $('#year').val();
    //     var region      = $('#region').val();
    //     var mth         = [];
    //     $.each($("input[name='cxm']:checked"), function(){
    //         mth.push($(this).val());
    //     });
        
    //     getsitelisttracking();
       
    // });

    

</script>

<script>
    /* chart.js chart examples */

    // chart colors
    var colors = ['#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];


    /* bar chart */
    var dataqty = [];
    
    // alert(dataqty1);

    // for(var i = 0; i < 2; i++){
    //     dataqty.push( {
    //                     data: [445, 483, 520],
    //                     backgroundColor: colors[0],
    //                     borderColor: colors[0],
    //                     borderWidth: 4,
    //                     pointBackgroundColor: colors[0]
    //                 });
    // }

   
    

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