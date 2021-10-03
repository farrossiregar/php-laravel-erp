@section('title', __('Application & Room'))
@section('parentPageTitle', 'Request')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#dashboard" wire:click="$emit('chart')">{{ __('Dashboard') }}</a></li>

                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#data-app">{{ __('Data App Request') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#data-room">{{ __('Data Room Request') }}</a></li>
                <!-- <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#datamaster">{{ __('Data Master Homebase') }}</a></li> -->

            </ul>
            <div class="tab-content">
                <div class="tab-pane active show " id="dashboard">
                    <livewire:application-room-request.dashboard />
                </div>
                <div class="tab-pane" id="data-app">
                    <livewire:application-room-request.data />
                </div>

                <div class="tab-pane" id="data-room">
                    <livewire:application-room-request.dataroom />
                </div>
                
            </div>
        </div>
        
    </div>
</div>

<div class="modal fade" id="modal-roomrequest-importroomrequest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:application-room-request.importroomrequest />
        </div>
    </div>
</div>


<div class="modal fade" id="modal-roomrequest-importapprequest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:application-room-request.importapprequest />
        </div>
    </div>
</div>


<div class="modal fade" id="modal-roomrequest-approveroomrequest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:application-room-request.approveroomrequest />
        </div>
    </div>
</div>


<div class="modal fade" id="modal-roomrequest-declineroomrequest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:application-room-request.declineroomrequest />
        </div>
    </div>
</div>

<!-- 
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

@endsection -->
