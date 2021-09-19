<div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Font Awesome -->
<!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"> -->
<!-- Google Fonts -->
<!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"> -->
<!-- Bootstrap core CSS -->
<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet"> -->
<!-- Material Design Bootstrap -->
<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet"> -->

<!-- JQuery -->
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<!-- Bootstrap tooltips -->
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script> -->
<!-- Bootstrap core JavaScript -->
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script> -->
<!-- MDB core JavaScript -->
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script> -->


    <div class="row">
        <div class="col-md-1">                
            <select class="form-control" wire:model="year">
                <option value=""> --- Year --- </option>
                @foreach(\App\Models\EmployeeNoc::select('year')->groupBy('year')->get() as $item) 
                <option>{{$item->year}}</option>
                @endforeach 
            </select>
        </div>
        <!-- <div class="col-md-2" wire:ignore>
            <select class="form-control" style="width:100%;" wire:model="month">
                <option value=""> --- Month --- </option>
                @foreach(\App\Models\EmployeeNoc::select('month')->groupBy('month')->orderBy('month','ASC')->get() as $item)
                <option value="{{$item->month}}">{{date('F', mktime(0, 0, 0, $item->month, 10))}}</option>
                @endforeach
            </select>
        </div> -->
        
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
<!-- 
    <div class="col-md-12">
        <div id="calendar"></div>
    </div> -->
</div>
@push('after-scripts')
<script src="{{ asset('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
<script src="{{ asset('assets/vendor/chartjs/Chart.bundle.min.js') }}?v=2"></script>

<script>
var labels = {!!$labels!!};
var datasets = {!!$datasets!!};
// var colors = ['#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];

// var dataslt = [];
// for(var i = 0; i < series.length; i++)  {
//     dataslt.push({
//             data: series[i],
//             backgroundColor: colors[i],
//             borderColor: colors[i],
//             borderWidth: 4,
//             pointBackgroundColor: colors[0]
//         });
// }

$( document ).ready(function() {
    
    // $('#calendar').fullCalendar({
        
    //     header: {
    //         left: 'prev,next today',
    //         center: 'addEventButton',
    //         right: 'month,agendaWeek,agendaDay,listWeek'
    //     },
    //     defaultDate: '2018-11-16',
    //     navLinks: true,
    //     editable: true,
    //     eventLimit: true,
    //     events: [{
    //         title: 'Simple static event',
    //         start: '2018-11-16',
    //         description: 'Super cool event'
    //         },

    //     ],
    //     customButtons: {
    //         addEventButton: {
    //         text: 'Add new event',
    //         click: function () {
    //             var dateStr = prompt('Enter date in YYYY-MM-DD format');
    //             var date = moment(dateStr);

    //             if (date.isValid()) {
    //             $('#calendar').fullCalendar('renderEvent', {
    //                 title: 'Dynamic event',
    //                 start: date,
    //                 allDay: true
    //             });
    //             } else {
    //             alert('Invalid Date');
    //             }

    //         }
    //         }
    //     },
    //     dayClick: function (date, jsEvent, view) {
    //         var date = moment(date);

    //         if (date.isValid()) {
    //         $('#calendar').fullCalendar('renderEvent', {
    //             title: 'Dynamic event from date click',
    //             start: date,
    //             allDay: true
    //         });
    //         } else {
    //         alert('Invalid');
    //         }
    //     },
    // });


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
    labels = JSON.parse(data.labels);
    datasets = JSON.parse(data.datasets);
    init_chart_databasenoc();
});
function init_chart_databasenoc(){
    var colors = ['#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];
    var chBar = document.getElementById("chBar");
                       
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
                    text: 'DUTY ROSTER MONTHLY - SITE PER PROJECT'
                },
                scales: {
                    xAxes: [{
                        barPercentage: 0.5,
                        categoryPercentage: 0.5
                    }]
                }
            }
        });
    }
}


</script>
@endpush