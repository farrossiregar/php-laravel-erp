@section('title', __('Vendor Management - Index'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div>
                <br>
            </div>
            <div>
                <br>
            </div>
            <div>
                <br>
            </div>
            <div>
                <br>
            </div>
            <div>
                <br>
            </div>
            <div>
                <br>
            </div>
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#dashboard" wire:click="$emit('chart')">{{ __('Dashboard') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#newsupplierregistration">{{ __('New Supplier Registration') }}</a></li>
                <!-- <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#supplierperformanceevaluation">{{ __('Supplier Performance Evaluation') }}</a></li> -->
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#supplierselection">{{ __('Supplier Selection') }}</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active show " id="dashboard">
                    <livewire:business-opportunities.dashboard />
                </div>
                <div class="tab-pane" id="newsupplierregistration">
                    <livewire:vendor-management.data />
                </div>
                <!-- <div class="tab-pane" id="supplierperformanceevaluation">
                    
                </div> -->
                <div class="tab-pane" id="supplierselection">
                    <livewire:business-opportunities.data />      
                </div>
            </div>
        </div>
        
    </div>
</div>

<div class="modal fade" id="modal-vendormanagement-serviceinput" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:vendor-management.serviceinput />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-vendormanagement-materialinput" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:vendor-management.materialinput />
        </div>
    </div>
</div>



<div class="modal fade" id="modal-vendormanagement-importlegal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:vendor-management.importlegal />
        </div>
    </div>
</div>
<div class="modal fade" id="modal-vendormanagement-importorgchart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:vendor-management.importorgchart />
        </div>
    </div>
</div>
<div class="modal fade" id="modal-vendormanagement-importtoolsresource" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:vendor-management.importtoolsresource />
        </div>
    </div>
</div>
<div class="modal fade" id="modal-vendormanagement-importcertificationresource" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:vendor-management.importcertificationresource />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-vendormanagement-servicecriteria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:vendor-management.servicecriteria />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-vendormanagement-materialcriteria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:vendor-management.materialcriteria />
        </div>
    </div>
</div>


@section('page-script')




    Livewire.on('modalinputservicesupplier',(data)=>{
        $("#modal-vendormanagement-serviceinput").modal('show');
    });

    Livewire.on('modalinputmaterialsupplier',(data)=>{
        $("#modal-vendormanagement-materialinput").modal('show');
    });



    Livewire.on('modalimportlegal',(data)=>{
        $("#modal-vendormanagement-importlegal").modal('show');
    });

    Livewire.on('modalimportorgchart',(data)=>{
        $("#modal-vendormanagement-importorgchart").modal('show');
    });

    Livewire.on('modalimporttoolsresource',(data)=>{
        $("#modal-vendormanagement-importtoolsresource").modal('show');
    });

    Livewire.on('modalimportcertificationresource',(data)=>{
        $("#modal-vendormanagement-importcertificationresource").modal('show');
    });



    Livewire.on('modalservicecriteria',(data)=>{
        $("#modal-vendormanagement-servicecriteria").modal('show');
    });

    Livewire.on('modalmaterialcriteria',(data)=>{
        $("#modal-vendormanagement-materialcriteria").modal('show');
    });




    Livewire.on('modalwonbo',(data)=>{
        $("#modal-businessopportunities-wonbo").modal('show');
    });

    Livewire.on('modalfailedbo',(data)=>{
        $("#modal-businessopportunities-failedbo").modal('show');
    });


@endsection