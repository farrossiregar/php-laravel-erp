@section('title', __('Asset Transfer Request - Index'))
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
                    <livewire:asset-transfer-request.dashboard />
                </div>
                <div class="tab-pane" id="data">
                    <livewire:asset-transfer-request.data />
                </div>
               
            </div>
        </div>
        
    </div>
</div>

<div class="modal fade" id="modal-assettransferrequest-add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:asset-transfer-request.add />
        </div>
    </div>
</div>



<div class="modal fade" id="modal-assettransferrequest-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:asset-transfer-request.edit />
        </div>
    </div>
</div>


<div class="modal fade" id="modal-assettransferrequest-detailasset" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:asset-transfer-request.detailasset />
        </div>
    </div>
</div>


<div class="modal fade" id="modal-assettransferrequest-approve" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:asset-transfer-request.approve />
        </div>
    </div>
</div>


<div class="modal fade" id="modal-assettransferrequest-decline" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:asset-transfer-request.decline />
        </div>
    </div>
</div>





@section('page-script')
    Livewire.on('modaladdassettransferrequest',(data)=>{
        
        $("#modal-assettransferrequest-add").modal('show');
    });


    Livewire.on('modaleditassettransferrequest',(data)=>{
        $("#modal-assettransferrequest-edit").modal('show');
    });


    Livewire.on('modaldetailasset',(data)=>{
        $("#modal-assettransferrequest-detailasset").modal('show');
    });


    Livewire.on('modalapproveassetrequest',(data)=>{
        $("#modal-assettransferrequest-approve").modal('show');
    });


    Livewire.on('modaldeclineassetrequest',(data)=>{
        $("#modal-assettransferrequest-decline").modal('show');
    });

@endsection