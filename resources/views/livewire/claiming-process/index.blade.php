@section('title', __('Claiming Process - Index'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#dashboard" wire:click="$emit('chart')">{{ __('Dashboard') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#data">{{ __('Data') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#datalimit">{{ __('Set Limit') }}</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active show " id="dashboard">
                    <livewire:claiming-process.dashboard />
                </div>
                <div class="tab-pane" id="data">
                    <livewire:claiming-process.data />
                </div>
                <div class="tab-pane" id="datalimit">
                    <livewire:claiming-process.setlimit />
                </div>
            </div>
        </div>
        
    </div>
</div>

<div class="modal fade" id="modal-claimingprocess-claim" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width:40%;">
        <div class="modal-content">
            <livewire:claiming-process.claim />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-claimingprocess-addlimit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:claiming-process.addlimit />
        </div>
    </div>
</div>




<div class="modal fade" id="modal-claimingprocess-approve" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:claiming-process.approve />
        </div>
    </div>
</div>


<div class="modal fade" id="modal-claimingprocess-decline" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:claiming-process.decline />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-claimingprocess-detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width:40%;">
        <div class="modal-content">
            <livewire:claiming-process.detail />
        </div>
    </div>
</div>


<div class="modal fade" id="modal-claimingprocess-approvalhistory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:claiming-process.approvalhistory />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-claimingprocess-importreceipt" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:claiming-process.importreceipt />
        </div>
    </div>
</div>





@section('page-script')
    Livewire.on('modalapproveclaimingprocess',(data)=>{
        $("#modal-claimingprocess-approve").modal('show');
    });
    
    Livewire.on('modaldeclineclaimingprocess',(data)=>{
        $("#modal-claimingprocess-decline").modal('show');
    });

    Livewire.on('modalimportreceipt',(data)=>{
        $("#modal-claimingprocess-importreceipt").modal('show');
    });
    
    Livewire.on('modalclaimticket',(data)=>{
        $("#modal-claimingprocess-claim").modal('show');
    });

    Livewire.on('modaladdlimit',(data)=>{
        $("#modal-claimingprocess-addlimit").modal('show');
    });

    Livewire.on('modaleditassetrequest',(data)=>{
        $("#modal-assetrequest-edit").modal('show');
    });

    Livewire.on('modaldetailticket',(data)=>{
        $("#modal-claimingprocess-detail").modal('show');
    });

    Livewire.on('modalapprovalhistoryclaimingprocess',(data)=>{
        $("#modal-claimingprocess-approvalhistory").modal('show');
    });

@endsection