@section('title', __('PO Tracking MS Index'))
{{-- @section('parentPageTitle', 'Home') --}}

<div class="row clearfix">
    <div class="col-lg-12">
        <div><br></div>
        <div><br></div>
        <div><br></div>
        <div class="card">
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#dashboard" wire:click="$emit('chart')">{{ __('Dashboard') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#data">{{ __('Data') }}</a></li>
                <!-- <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#datamaster">{{ __('Data Master Homebase') }}</a></li> -->
            </ul>
            <div class="tab-content">
                <div class="tab-pane active show " id="dashboard">
                    <livewire:po-tracking-ms.dashboard />
                </div>
                <div class="tab-pane" id="data">
                    <livewire:po-tracking-ms.data />
                </div>
                
            </div>
        </div>
        
    </div>
</div>




<div class="modal fade" id="modal-potrackingms-uploadmspo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:po-tracking-ms.importmspo />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-potrackingms-uploadpds" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:po-tracking-ms.importpds />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-potrackingms-uploadapprovaldocs" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:po-tracking-ms.importapprovaldocs />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-potrackingms-uploadapprovedverificationdocs" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:po-tracking-ms.importapprovedverificationdocs />
        </div>
    </div>
</div>


@section('page-script')


    Livewire.on('modaluploadmspo',(data)=>{
        $("#modal-potrackingms-uploadmspo").modal('show');
    });

    Livewire.on('modaluploadpds',(data)=>{
        $("#modal-potrackingms-uploadpds").modal('show');
    });

    Livewire.on('modaluploadapprovaldocs',(data)=>{
        $("#modal-potrackingms-uploadapprovaldocs").modal('show');
    });

    Livewire.on('modaluploadapprovedverificationdocs',(data)=>{
        $("#modal-potrackingms-uploadapprovedverificationdocs").modal('show');
    });

    
 

@endsection