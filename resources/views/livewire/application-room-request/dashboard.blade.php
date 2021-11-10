<div>
    <style>
        #external-events {
            float: left;
            width: 150px;
            padding: 0 10px;
            text-align: left;
            }

        #external-events h4 {
            font-size: 16px;
            margin-top: 0;
            padding-top: 1em;
            }

        .external-event { /* try to mimick the look of a real event */
            margin: 10px 0;
            padding: 2px 4px;
            background: #3366CC;
            color: #fff;
            font-size: .85em;
            cursor: pointer;
            }

        #external-events p {
            margin: 1.5em 0;
            font-size: 11px;
            color: #666;
            }

        #external-events p input {
            margin: 0;
            vertical-align: middle;
        }

        #calendar {
            margin: 0 auto;
            width: 900px;
            background-color: #FFFFFF;
            border-radius: 6px;
            box-shadow: 0 1px 2px #C3C3C3;
        }
    </style>
    <div class="row">
        <div class="col-md-1">                
            <select class="form-control" wire:model="year">
                <option value=""> --- Year --- </option>
                <option value="2021">2021</option>
                <option value="2020">2020</option>
                <option value="2019">2019</option>
                <option value="2018">2018</option>
                <option value="2017">2017</option>
                
            
            </select>
        </div>
        <div class="col-md-2" wire:ignore>
            <select class="form-control" style="width:100%;" wire:model="month">
                <option value=""> --- Month --- </option>
                <?php
                    for($i = 1; $i <= 12; $i++){
                ?>
                <option value="{{$i}}">{{date('F', mktime(0, 0, 0, $i, 10))}}</option>
                <?php
                    }
                ?>
            </select>
        </div>
        
        <div class="col-md-7">
            <label wire:loading>
                <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                <span class="sr-only">{{ __('Loading...') }}</span>
            </label>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6" style="height: 300px">
            <canvas id="chBar"></canvas>
        </div>
        <div class="col-md-6" style="height: 300px">
            <canvas id="chBar1"></canvas>
        </div>
        <div class="col-md-6 mt-3" wire:ignore>
            <div id='wrap' style="margin: 5px;">
                <div id='calendar' class="col-md-12" onclick="return false;"></div>
            </div>
        </div>
        <div class="col-md-4 mt-3">
            <div class="row">
                <div class="col-md-8">
                    <h5>Room Request <span class="text-danger">{{$date_active}}</span></h5>
                </div>
                <div class="col-md-4 text-right">
                    <a href="#" data-toggle="modal" data-target="#modal-roomrequest-importroomrequest" title="Add" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Room Request')}}</a>
                </div>
            </div>
            <hr />
            @foreach($data_room as $item)
                <div class="border rounded mb-3">
                    <table class="table mb-0">
                        <tr>
                            <th>Room</th>
                            <td>{{$item->request_room_detail}}</td>
                        </tr>
                        <tr>
                            <th>Purpose</th>
                            <td>{{$item->purpose}}</td>
                        </tr>
                        <tr>
                            <th>Time</th>
                            <td>{{date('H:i',strtotime($item->start_date))}} - {{date('H:i',strtotime($item->end_date))}}</td>
                        </tr>
                        <tr>
                            <th>Participant</th>
                            <td>{{$item->participant}}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if($item->status == '1')
                                <label class="badge badge-warning mb-0" data-toggle="tooltip" title="Waiting PMG Approval">Waiting PMG Approval</label>
                            @endif

                            @if($item->status == '2')
                                <label class="badge badge-success mb-0" data-toggle="tooltip" title="Approved">Approved</label>
                            @endif

                            @if($item->status == '0')
                                <label class="badge badge-danger mb-0" data-toggle="tooltip" title="{{ $item->note }}">Decline</label>
                            @endif

                            @if($item->status == '' || $item->status == 'null')
                                <label class="badge badge-warning mb-0" data-toggle="tooltip" title="Waiting to Approve">Waiting to Approve</label>
                            @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Department</th>
                            <td>{{ $item->departement }}</td>
                        </tr>
                        <tr>
                            <th>Requested By</th>
                            <td>
                                {{ $item->employee_name }}
                            </td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{ date_format(date_create($item->created_at), 'd M Y') }}</td>
                        </tr>
                    </table>
                </div>
            @endforeach
            @if($data_room->count()==0)
                <code>Room request empty.</code>
            @endif
        </div>
    </div>
</div>

@push('after-scripts')
    <script>
        $(document).ready(function() {
            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();

            /* initialize the external events
            -----------------------------------------------------------------*/
            $('#external-events div.external-event').each(function() {

                // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                // it doesn't need to have a start or end
                var eventObject = {
                    title: $.trim($(this).text()) // use the element's text as the event title
                };

                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject);

                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 999,
                    revert: true,      // will cause the event to go back to its
                    revertDuration: 0  //  original position after the drag
                });
            });

            var titles = {!!$title!!};
            var startdates = {!!$startdate!!};
            var enddates = {!!$enddate!!};
            var events = [];
            var coolor = [];
            for(var i = 0; i < startdates.length; i++) 
            {
                events.push( {
                        title: 'Booking ruang ' + titles[i]['request_room_detail'], 
                        start: startdates[i]['start_booking'].substring(0, 10), 
                        end: startdates[i]['start_booking'].substring(0, 10),
                        className: 'info'
                });
            }
            
            /* initialize the calendar
            -----------------------------------------------------------------*/
            var calendar =  $('#calendar').fullCalendar({
                header: {
                    left: 'title',
                    center: 'agendaDay,agendaWeek,month',
                    right: 'prev,next today'
                },
                editable: true,
                firstDay: 1, //  1(Monday) this can be changed to 0(Sunday) for the USA system
                selectable: true,
                defaultView: 'month',
                axisFormat: 'h:mm',
                columnFormat: {
                    month: 'ddd',    // Mon
                    week: 'ddd d', // Mon 7
                    day: 'dddd M/d',  // Monday 9/7
                    agendaDay: 'dddd d'
                },
                titleFormat: {
                    month: 'MMMM yyyy', // September 2009
                    week: "MMMM yyyy", // September 2009
                    day: 'MMMM yyyy'                  // Tuesday, Sep 8, 2009
                },
                allDaySlot: false,
                selectHelper: true,
                select: function(start, end, allDay) {
                    Livewire.emit('set_selected_date',start);
                },
                droppable: true, // this allows things to be dropped onto the calendar !!!
                drop: function(date, allDay) { // this function is called when something is dropped
                },
                events: events,
            });
        });

    </script>
<script src="{{ asset('assets/vendor/chartjs/Chart.bundle.min.js') }}?v=2"></script>
<link href="{{ asset('assets/fullcalendar-master/assets/css/fullcalendar.css') }}" rel='stylesheet' />
<link href="{{ asset('assets/fullcalendar-master/assets/css/fullcalendar.print.css') }}" rel='stylesheet' media='print' />
<script src="{{ asset('assets/fullcalendar-master/assets/js/fullcalendar.js') }}" type="text/javascript"></script>
<script>
    var labels = {!!$labels!!};
    var datasets = {!!$datasets!!};
    var labelsapp = [];
    var labelsapp = {!!$labelsapp!!};
    var datasetsapp = [];
    var datasetsapp = {!!$datasetsapp!!};

    $( document ).ready(function() {
        init_chart_applicationroomreq();
    });
    Livewire.on('init-chart',(data)=>{
        labels = JSON.parse(data.labels);
        datasets = JSON.parse(data.datasets);
        labelsapp = JSON.parse(data.labelsapp);
        
        datasetsapp = JSON.parse(data.datasetsapp);
        // alert(datasetsapp.length);
        init_chart_applicationroomreq();
    });
    function init_chart_applicationroomreq(){
        // var colors = ['#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];
        var colors = ['#ffb1c1','#4b89d6','#add64b','#80b10a','#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];
        var chBar = document.getElementById("chBar");
        var chBar1 = document.getElementById("chBar1");

        var dataapps = [];
        for(var i = 0; i < datasetsapp.length; i++) {
            dataapps.push( {
                    label: labelsapp[i]['request_room_detail'], 
                    backgroundColor: colors[i], 
                    fill: 'boundary',
                    data: [ datasetsapp[i]['jumlahrequest'] ]
                    
            });
        }

        var dataroom = [];
        for(var i = 0; i < datasets.length; i++) {
            dataroom.push( {
                    label: labels[i]['request_room_detail'], 
                    backgroundColor: colors[i], 
                    fill: 'boundary',
                    data: [ datasets[i]['jumlahrequest'] ]
                    
            });   
        }

        if (chBar) {
            new Chart(chBar, {
                type: 'bar',
                data: {
                    labels: labelsapp['request_room_detail'],
                    datasets: dataapps,
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
                        text: 'APPLICATION REQUEST - AVERAGE TIME EXECUTION'
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

        if (chBar1) {
            new Chart(chBar1, {
                type: 'bar',
                data: {
                    labels: labels['request_room_detail'],
                    datasets: dataroom,
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
                        text: 'ROOM REQUEST - MONTHLY REQUEST'
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
<!-- endsection -->
@section('page-script')
    Livewire.on('modalrevisiroomrequest',(data)=>{
        $("#modal-roomrequest-revisiroomrequest").modal('show');
    });
    Livewire.on('modalapproveroomrequest',(data)=>{
        $("#modal-roomrequest-approveroomrequest").modal('show');
    });
    Livewire.on('modaldeclineroomrequest',(data)=>{
        $("#modal-roomrequest-declineroomrequest").modal('show');
    });
@endsection
