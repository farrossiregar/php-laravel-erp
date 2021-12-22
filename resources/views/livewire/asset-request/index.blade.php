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

<div class="modal fade" id="modal-hotelflight-add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:asset-request.add />
        </div>
    </div>
</div>



<div class="modal fade" id="modal-hotelflight-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:hotel-flight-ticket.edit />
        </div>
    </div>
</div>


<div class="modal fade" id="modal-hotelflightticket-approve" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:hotel-flight-ticket.approve />
        </div>
    </div>
</div>


<div class="modal fade" id="modal-hotelflightticket-decline" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:hotel-flight-ticket.decline />
        </div>
    </div>
</div>





@section('page-script')
    Livewire.on('modaladdhotelflight',(data)=>{
        
        $("#modal-hotelflight-add").modal('show');
    });


    Livewire.on('modaledithotelflightticket',(data)=>{
        $("#modal-hotelflight-edit").modal('show');
    });


    Livewire.on('modalapprovehotelflightticket',(data)=>{
        $("#modal-hotelflightticket-approve").modal('show');
    });


    Livewire.on('modaldeclinehotelflightticket',(data)=>{
        $("#modal-hotelflightticket-decline").modal('show');
    });

@endsection