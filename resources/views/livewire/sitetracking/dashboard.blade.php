@section('title', __('Site Tracking Dashboard'))
@section('parentPageTitle', 'Home')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header row">
                <div class="row my-3">
                    <div class="col">
                        <h4>NETWORK GROWTH MD EID ISAT</h4>
                    </div>
                </div>

            </div>

            <div class="body pt-0">
                <div class="row my-2">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="cxm" value="01" value="m01">
                        <label class="form-check-label" for="flexCheckDefault">
                            January
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="cxm" value="02" value="m02">
                        <label class="form-check-label" for="flexCheckDefault">
                            February
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="cxm" value="03" value="m03">
                        <label class="form-check-label" for="flexCheckDefault">
                            March
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="cxm" value="04" value="m04">
                        <label class="form-check-label" for="flexCheckDefault">
                            April
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="cxm" value="05" value="m05">
                        <label class="form-check-label" for="flexCheckDefault">
                            May
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="cxm" value="06" value="m06">
                        <label class="form-check-label" for="flexCheckDefault">
                            June
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="cxm" value="07" value="m07">
                        <label class="form-check-label" for="flexCheckDefault">
                            July
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="cxm" value="08" value="m08">
                        <label class="form-check-label" for="flexCheckDefault">
                            August
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="cxm" value="09" value="m09">
                        <label class="form-check-label" for="flexCheckDefault">
                            September
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="cxm" value="10" id="m10">
                        <label class="form-check-label" for="flexCheckDefault">
                            October
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="cxm" value="11" id="m11">
                        <label class="form-check-label" for="flexCheckDefault">
                            November
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="cxm" value="12" id="m12">
                        <label class="form-check-label" for="flexCheckDefault">
                            December
                        </label>
                    </div>
                   
                </div>
                <div class="row my-2">
                    <div class="col-md-2 px-0">
                        <select class="form-control" id="year">
                            <option value=""> --- Year --- </option>
                            <option value="2021">2021</option>
                            <option value="2020">2020</option>
                            <option value="2019">2019</option>
                            <option value="2018">2018</option>
                            
                        </select>
                    </div>
                    <div class="col-md-2 px-0">
                        <!-- <div href="#" class="btn btn-primary" onclick="getsitelisttracking()"><i class="fa fa-search"></i>Submit</div> -->
                        <!-- <div href="#" class="btn btn-primary"><i class="fa fa-search"></i>Submit</div> -->
                    </div>
                    
                </div>
                <div class="row my-2">
                    <div class="col-md-8 py-1">
                        <div class="card">
                            <div class="card-body">
                                <canvas id="chBar"></canvas>
                                <!-- <div id="multiple-chart" class="ct-chart"></div> -->
                                <!-- <canvas id="chLine"></canvas> -->
                            </div>
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
var colors = ['#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];

var dataslt = [];
for(var i = 0; i < series.length; i++)  {
    dataslt.push({
            data: series[i],
            backgroundColor: colors[i],
            borderColor: colors[i],
            borderWidth: 4,
            pointBackgroundColor: colors[0]
        });
}

$( document ).ready(function() {
    init_chart_sitelisttracking();
});
Livewire.on('init-chart',(data)=>{
    labels = JSON.parse(data.labels);
    series = JSON.parse(data.series);
    init_chart_sitelisttracking();
});

function init_chart_sitelisttracking(){
    var colors = ['#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];
    var chBar = document.getElementById("chBar");
                       
    if (chBar) {
        new Chart(chBar, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: dataslt,
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