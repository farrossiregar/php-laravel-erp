<div>
    <style>
        .borderlinerad {
            border: 1px solid lightgrey; border-radius: 5px; padding: 10px 0; width: 100%; height: 100%; margin: auto;
        }
    </style>
    <div class="row">
        <div class="col-md-1">                
            <select class="form-control" wire:model="year">
                <option value=""> --- Year --- </option>
                
                <option value="2022">2022</option>
                <option value="2021">2021</option>
                <option value="2020">2020</option>
                <option value="2019">2019</option>
                <option value="2018">2018</option>
                
            </select>
        </div>

        <div class="col-md-2" wire:ignore>
            <select class="form-control" style="width:100%;" wire:model="month">
                <option value=""> --- Month --- </option>
                @for($i = 1; $i <= 12; $i++)
                    <option value="{{$i}}">{{date('F', mktime(0, 0, 0, $i, 10))}}</option>
                @endfor
            </select>
        </div>

        <!-- <div class="col-md-2">                
            <select onclick="" class="form-control" wire:model="category_item">
                <option value=""> --- Category Item --- </option>
                <option value="1">Stationary</option>
                <option value="2">Pantry Supplies</option>
                <option value="3">Electrical Supplies</option>
                <option value="4">Office Supplies</option>
            </select>
        </div> -->

        
    </div>

    <br>

    
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12 borderlinerad">
                <br>
                <div class="row">
                    <div class="col-md-4" style="margin: 0 20px;">      
                        <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#detailitemdatabase"> Consumable Item Database </button>
                    </div>    
                </div>
                <br><br>


                
                <div class="row collapse" id="detailitemdatabase"  style="margin: 0 10px;">
                    <div class="col-md-12" >
                        <div class="row">
                            <div class="col-md-6" >
                                <div class="row form-group borderlinerad">
                                    <br>
                                    <div class="col-md-12">
                                        <h5>Stationary</h5>
                                    </div>
                                    <hr>
                                    <br>
                                    @foreach(\App\Models\ConsumableItemDatabase::where('item_category', '1')->whereRaw('stock < 3')->groupBy('item_name')->get() as $item)
                                    <div class="col-md-3">
                                        <div class="card overflowhidden number-chart" style="background-color: #604a7b;">
                                            <div class="body">
                                                <div class="number">
                                                    <h6 style="color: white;">{{ $item->item_name }}</h6>
                                                    <span id="aging" style="color: white;">{{ $item->stock }}</span>
                                                </div>
                                                <small class="text-muted"><p style="color: white;">(Low : < 3 Unit)</p> </small>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    
                                </div>
                            </div>

                            <div class="col-md-6" >
                                <div class="row  form-group borderlinerad">
                                    <br>
                                    <div class="col-md-12">
                                        <h5>Pantry Supplies</h5>
                                    </div>
                                    <hr>
                                    <br>
                                    @foreach(\App\Models\ConsumableItemDatabase::where('item_category', '2')->whereRaw('stock < 3')->groupBy('item_name')->get() as $item)
                                    <div class="col-md-3">
                                        <div class="card overflowhidden number-chart" style="background-color: #dc3545;">
                                            <div class="body">
                                                <div class="number">
                                                    <h6 style="color: white;">{{ $item->item_name }}</h6>
                                                    <span id="aging" style="color: white;">{{ $item->stock }}</span>
                                                </div>
                                                <small class="text-muted"><p style="color: white;">(Low : < 3 Unit)</p> </small>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    
                                </div>
                            </div>
                        </div>

                        <br><br>

                        <div class="row">
                            <div class="col-md-6" >
                                <div class="row  form-group borderlinerad">
                                    <br>
                                    <div class="col-md-12">
                                        <h5>Electric Supplies</h5>
                                    </div>
                                    <hr>
                                    <br>
                                    @foreach(\App\Models\ConsumableItemDatabase::where('item_category', '3')->whereRaw('stock < 3')->groupBy('item_name')->get() as $item)
                                    <div class="col-md-3">
                                        <div class="card overflowhidden number-chart" style="background-color: #92cddc;">
                                            <div class="body">
                                                <div class="number">
                                                    <h6 style="color: white;">{{ $item->item_name }}</h6>
                                                    <span id="aging" style="color: white;">{{ $item->stock }}</span>
                                                </div>
                                                <small class="text-muted"><p style="color: white;">(Low : < 3 Unit)</p> </small>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    
                                </div>
                            </div>

                            <div class="col-md-6" >
                                <div class="row  form-group borderlinerad">
                                    <br>
                                    <div class="col-md-12">
                                        <h5>Office Supplies</h5>
                                    </div>
                                    <hr>
                                    <br>
                                    @foreach(\App\Models\ConsumableItemDatabase::where('item_category', '4')->whereRaw('stock < 3')->groupBy('item_name')->get() as $item)
                                    <div class="col-md-3">
                                        <div class="card overflowhidden number-chart" style="background-color: #fac091;">
                                            <div class="body">
                                                <div class="number">
                                                    <h6 style="color: white;">{{ $item->item_name }}</h6>
                                                    <span id="aging" style="color: white;">{{ $item->stock }}</span>
                                                </div>
                                                <small class="text-muted"><p style="color: white;">(Low : < 3 Unit)</p> </small>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <br><br>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12 borderlinerad" style="height: 400px; margin-bottom: 10px;">
                <br>
                <div class="row">
                    <div class="col-md-1" style="margin: 0 20px;">
                        <a href="javascript:;" wire:click="$emit('modalimportasset')" class="btn btn-info"><i class="fa fa-eye"></i> Consumable Item Request </a>
                    </div>
                </div>
                <br><br>
                <canvas id="chBar"></canvas>
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
   
</div>
@push('after-scripts')
<script src="{{ asset('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
<script src="{{ asset('assets/vendor/chartjs/Chart.bundle.min.js') }}?v=2"></script>

<script>
var labels      = {!!$labels!!};
var datasets    = {!!$datasets!!};
// var totalasset  = {!!$totalasset!!};
// var aging       = {!!$aging!!};
// var expired     = {!!$expired!!};

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
    // totalasset  = JSON.parse(data.totalasset);
    // aging       = JSON.parse(data.aging);
    // expired     = JSON.parse(data.expired);

    // $('#totalasset').html(totalasset);
    // $('#aging').html(aging);
    // $('#expired').html(expired);

    
    
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
                    text: 'TOTAL COST BY CATEGORY - MONTHLY'
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