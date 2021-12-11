@section('title', __('Petty Cash - Index'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#dashboard" wire:click="$emit('chart')">{{ __('Dashboard') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#data">{{ __('Data') }}</a></li>
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

<div class="modal fade" id="modal-pettycash-revisipettycash" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:petty-cash.revisipettycash />
        </div>
    </div>
</div>


<div class="modal fade" id="modal-pettycash-approvepettycash" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:petty-cash.approvepettycash />
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

<div class="modal fade" id="modal-pettycash-declinepettycash" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:petty-cash.declinepettycash />
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

    Livewire.on('modalrevisipettycash',(data)=>{
        $("#modal-pettycash-revisipettycash").modal('show');
    });

    Livewire.on('modalapprovereceipt',(data)=>{
        $("#modal-pettycash-approvereceipt").modal('show');
    });

    Livewire.on('modalapprovepettycash',(data)=>{
        $("#modal-pettycash-approvepettycash").modal('show');
    });

    Livewire.on('modaldeclinereceipt',(data)=>{
        $("#modal-pettycash-declinereceipt").modal('show');
    });

    Livewire.on('modaldeclinepettycash',(data)=>{
        $("#modal-pettycash-declinepettycash").modal('show');
    });

@endsection