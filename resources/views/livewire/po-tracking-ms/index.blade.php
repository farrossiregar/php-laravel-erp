@section('title', __('PO Tracking MS Index'))
@section('parentPageTitle', 'Home')

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
                    <livewire:po-tracking-ms.data />
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

<div class="modal fade" id="modal-potrackingms-uploadacceptancedocs" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:po-tracking-ms.importacceptancedocs />
        </div>
    </div>
</div>


<div class="modal fade" id="modal-potrackingms-approvemspo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:po-tracking-ms.approvemspo />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-potrackingms-approvepmgreview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:po-tracking-ms.approvepmgreview />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-potrackingms-approvedeductionregional" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:po-tracking-ms.approvedeductionregional />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-potrackingms-approvee2epds" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:po-tracking-ms.approvee2epds />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-potrackingms-approvee2eappdocs" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:po-tracking-ms.approvee2eappdocs />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-potrackingms-declinemspo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:po-tracking-ms.declinemspo />
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

    Livewire.on('modaluploadappverdocs',(data)=>{
        $("#modal-potrackingms-uploadapprovedverificationdocs").modal('show');
    });

    Livewire.on('modaluploadaccdocs',(data)=>{
        $("#modal-potrackingms-uploadacceptancedocs").modal('show');
    });

    Livewire.on('modalapprovemspo',(data)=>{
        $("#modal-potrackingms-approvemspo").modal('show');
    });

    Livewire.on('modalapprovepmgreview',(data)=>{
        $("#modal-potrackingms-approvepmgreview").modal('show');
    });

    Livewire.on('modalapprovedeductionregional',(data)=>{
        $("#modal-potrackingms-approvedeductionregional").modal('show');
    });

    Livewire.on('modalapprovee2epds',(data)=>{
        $("#modal-potrackingms-approvee2epds").modal('show');
    });

    Livewire.on('modalapprovee2eappdocs',(data)=>{
        $("#modal-potrackingms-approvee2eappdocs").modal('show');
    });

    Livewire.on('modaldeclinemspo',(data)=>{
        $("#modal-potrackingms-declinemspo").modal('show');
    });
    
 

@endsection

