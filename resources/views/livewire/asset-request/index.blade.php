@section('title', __('Asset Request - Index'))
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
                    <livewire:asset-request.dashboard />
                </div>
                <div class="tab-pane" id="data">
                    <livewire:asset-request.data />
                </div>
               
            </div>
        </div>
        
    </div>
</div>

<div class="modal fade" id="modal-assetrequest-add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:asset-request.add />
        </div>
    </div>
</div>



<div class="modal fade" id="modal-assetrequest-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:asset-request.edit />
        </div>
    </div>
</div>


<div class="modal fade" id="modal-assetrequest-approve" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:asset-request.approve />
        </div>
    </div>
</div>


<div class="modal fade" id="modal-assetrequest-decline" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:asset-request.decline />
        </div>
    </div>
</div>





@section('page-script')
    Livewire.on('modaladdassetrequest',(data)=>{
        
        $("#modal-assetrequest-add").modal('show');
    });


    Livewire.on('modaleditassetrequest',(data)=>{
        $("#modal-assetrequest-edit").modal('show');
    });


    Livewire.on('modalapproveassetrequest',(data)=>{
        $("#modal-assetrequest-approve").modal('show');
    });


    Livewire.on('modaldeclineassetrequest',(data)=>{
        $("#modal-assetrequest-decline").modal('show');
    });

@endsection