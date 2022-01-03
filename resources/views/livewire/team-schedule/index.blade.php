@section('title', __('Team Schedule & Timesheet Record - Index'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#dashboard" wire:click="$emit('chart')">{{ __('Dashboard') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#data">{{ __('Data') }}</a></li>
                <!-- <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#datapmt">{{ __('Data PMT') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#datahup">{{ __('Data HUP') }}</a></li> -->
            </ul>
            <div class="tab-content">
                <div class="tab-pane active show " id="dashboard">
                    <livewire:team-schedule.dashboard />
                </div>
                <div class="tab-pane" id="data">
                    <livewire:team-schedule.data />
                </div>
               
            </div>
        </div>
        
    </div>
</div>

<div class="modal fade" id="modal-teamschedule-add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:team-schedule.add />
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

<div class="modal fade" id="modal-teamschedule-approvalhistoryteamschedule" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:team-schedule.approvalhistory />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-teamschedule-approveteamschedule" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:team-schedule.approve />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-pettycash-approvereceipt" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:petty-cash.approvereceipt />
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

<div class="modal fade" id="modal-pettycash-declinereceipt" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:petty-cash.declinereceipt />
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

    Livewire.on('modalapprovereceipt',(data)=>{
        $("#modal-pettycash-approvereceipt").modal('show');
    });

    Livewire.on('modalapproveteamschedule',(data)=>{
        $("#modal-teamschedule-approveteamschedule").modal('show');
    });

    Livewire.on('modalapprovalhistoryteamschedule',(data)=>{
        $("#modal-teamschedule-approvalhistoryteamschedule").modal('show');
    });

    Livewire.on('modaldeclinereceipt',(data)=>{
        $("#modal-pettycash-declinereceipt").modal('show');
    });

    Livewire.on('modaldeclineteamschedule',(data)=>{
        $("#modal-teamschedule-declineteamschedule").modal('show');
    });

@endsection

