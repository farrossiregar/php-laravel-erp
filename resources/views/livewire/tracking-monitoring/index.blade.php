@section('title', __('Timesheet Record - Index'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#dashboard" wire:click="$emit('chart')">{{ __('Dashboard') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#datapmt">{{ __('Data PMT') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#datahup">{{ __('Data HUP') }}</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active show " id="dashboard">
                    <livewire:timesheet-record.dashboard />
                </div>
                <div class="tab-pane" id="datapmt">
                    <livewire:timesheet-record.datapmt />
                </div>
                <div class="tab-pane" id="datahup">
                    <livewire:timesheet-record.datahup />
                </div>
            </div>
        </div>
        
    </div>
</div>



<div class="modal fade" id="modal-teamschedule-importactual" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:team-schedule.importactual />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-teamschedule-generatetimesheet" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:team-schedule.generatetimesheet />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-teamschedule-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:team-schedule.edit />
        </div>
    </div>
</div>


<div class="modal fade" id="modal-timesheetrecord-approvetimesheetrecord" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:timesheet-record.approve />
        </div>
    </div>
</div>


<div class="modal fade" id="modal-teamschedule-declineteamschedule" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:team-schedule.decline />
        </div>
    </div>
</div>




@section('page-script')
    Livewire.on('modaladdteamschedule',(data)=>{
        
        $("#modal-teamschedule-add").modal('show');
    });

    Livewire.on('modalimportactual',(data)=>{
        $("#modal-teamschedule-importactual").modal('show');
    });

    Livewire.on('modalgeneratetimesheet',(data)=>{
        $("#modal-teamschedule-generatetimesheet").modal('show');
    });

    Livewire.on('modaleditteamschedule',(data)=>{
        $("#modal-teamschedule-edit").modal('show');
    });

    Livewire.on('modalapprovetimesheetrecord',(data)=>{
        $("#modal-timesheetrecord-approvetimesheetrecord").modal('show');
    });

 

    Livewire.on('modaldeclineteamschedule',(data)=>{
        $("#modal-teamschedule-declineteamschedule").modal('show');
    });

@endsection