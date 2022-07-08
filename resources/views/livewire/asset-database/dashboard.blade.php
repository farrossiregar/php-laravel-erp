<div>
    <div class="row">
        <!-- <div class="col-md-2">
            <div class="card overflowhidden number-chart" style="background-color: #fac091;">
                <div class="body">
                    <div class="number">
                        <h6>Asset Request Aging</h6>
                        <span id="aging"></span>
                    </div>
                    <small class="text-muted">Asset Request > 2 Weeks</small>
                </div>
                <div class="sparkline" data-type="line" data-spot-Radius="0" data-offset="90" data-width="100%" data-height="50px"
                data-line-Width="1" data-line-Color="#fac091" data-fill-Color="#fac091">1,4,2,3,6,2</div>
            </div>
        </div> -->

        <div class="col-md-3">
            <div class="card overflowhidden number-chart" style="background-color: #fac091;">
                <div class="body p-2 text-center">
                    <div class="number">
                        <h6>Total Asset Aging</h6>
                        <span id="totalasset">0</span>
                    </div>
                    <small class="text-muted">Total Asset Aging</small>
                </div>
               
            </div>
        </div>

        <div class="col-md-3">
            <div class="card overflowhidden number-chart" style="background-color: #604a7b;">
                <div class="body p-2 text-center">
                    <div class="number">
                        <h6 style="color: white;">Asset Aging</h6>
                        <span id="aging" style="color: white;">0</span>
                    </div>
                    <small class="text-muted">Asset > 3 Years</small>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card overflowhidden number-chart" style="background-color: #92cddc;">
                <div class="body p-2 text-center">
                    <div class="number">
                        <h6>Expired Asset</h6>
                        <span id="expired">0</span>
                    </div>
                    <small class="text-muted">Expired Asset</small>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <label wire:loading>
                <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                <span class="sr-only">{{ __('Loading...') }}</span>
            </label>
        </div>
    </div>
    <!-- <div class="mt-4" style="height: 300px">
        <canvas id="chBar"></canvas>
    </div> -->
<!-- 
    <div class="mt-4" style="height: 300px">
        <canvas id="chBar1"></canvas>
    </div> -->
</div>
@push('after-scripts')
<script src="{{ asset('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
<script src="{{ asset('assets/vendor/chartjs/Chart.bundle.min.js') }}?v=2"></script>

<script>
var labels      = {!!$labels!!};
var datasets    = {!!$datasets!!};
var totalasset  = {!!$totalasset!!};
var aging       = {!!$aging!!};
var expired     = {!!$expired!!};

// var colors = ['#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];


$( document ).ready(function() {
    // $('.multiselect_month').multiselect({ 
    //         nonSelectedText: ' --- All Month --- ',
    //         onChange: function (option, checked) {
    //             @this.set('month', $('.multiselect_month').val());
    //         },
    //         buttonWidth: '100%'
    //     }
    // );
    init_chart_databasenoc();
});
Livewire.on('init-chart',(data)=>{
    labels      = JSON.parse(data.labels);
    datasets    = JSON.parse(data.datasets);
    totalasset  = JSON.parse(data.totalasset);
    aging       = JSON.parse(data.aging);
    expired     = JSON.parse(data.expired);

    $('#totalasset').html(totalasset);
    $('#aging').html(aging);
    $('#expired').html(expired);

    
    
    init_chart_databasenoc();
});
function init_chart_databasenoc(){
    var colors = ['#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];
    var chBar = document.getElementById("chBar");
    // var chBar1 = document.getElementById("chBar1");
                       
    if (chBar) {
        new Chart(chBar, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: datasets,
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
                legend: {
                    display: true,
                    position:'bottom'
                },
                title: {
                    display: true,
                    text: 'REQUEST ASSET - MONTHLY'
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

    // if (chBar1) {
    //     new Chart(chBar1, {
    //         type: 'bar',
    //         data: {
    //             labels: labels,
    //             datasets: datasetsamount,
    //         },
    //         options: {
    //             maintainAspectRatio: false,
    //             responsive: true,
    //             legend: {
    //                 display: true,
    //                 position:'bottom'
    //             },
    //             title: {
    //                 display: true,
    //                 text: 'AMOUNT SPENT - MONTHLY'
    //             },
    //             scales: {
    //                 xAxes: [{
    //                     barPercentage: 0.4,
    //                     categoryPercentage: 0.5
    //                 }]
    //             }
    //         }
    //     });
    // }
}
</script>
@endpush