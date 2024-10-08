@section('title', __('Vendor Management'))
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div>
                <br>
            </div>
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#newsupplierregistration">{{ __('New Supplier Registration') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#supplierselection">{{ __('Supplier Selection') }}</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active show" id="newsupplierregistration">
                    <livewire:vendor-management.data />
                </div>
                <div class="tab-pane" id="supplierselection">
                    <livewire:vendor-management.datasupplierselection /> 
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

<!-- <div class="modal fade" id="modal-vendormanagement-servicecriteria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
        </div>
    </div>
</div> -->

<div class="modal fade" id="modal-vendormanagement-materialcriteria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:vendor-management.materialcriteria />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-vendormanagement-criteriageneralinformation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
        </div>
    </div>
</div>

<div class="modal fade" id="modal-vendormanagement-criteriateamavailability" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
        </div>
    </div>
</div>

<div class="modal fade" id="modal-vendormanagement-criteriatoolsfacility" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
        </div>
    </div>
</div>

<div class="modal fade" id="modal-vendormanagement-criteriacc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
        </div>
    </div>
</div>



<div class="modal fade" id="modal-vendormanagement-criteriaehs" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
        </div>
    </div>
</div>




<div class="modal fade" id="modal-vendormanagement-newproject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:vendor-management.newproject />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-vendormanagement-summarynote" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:vendor-management.summarynote />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-vendormanagement-improvementpoint" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:vendor-management.improvementpoint />
        </div>
    </div>
</div>



<div class="modal fade" id="modal-vendormanagement-viewcomparation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="max-width:70%;">
        <div class="modal-content">
            <livewire:vendor-management.viewcomparation />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-vendormanagement-detailscore" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:vendor-management.detailscore />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-vendormanagement-initialscore" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:vendor-management.initialscore />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-vendormanagement-addsupp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:vendor-management.addsupplier />
        </div>
    </div>
</div>



@section('page-script')


    Livewire.on('modalinputnewproject',(data)=>{
        $("#modal-vendormanagement-newproject").modal('show');
    });

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

    Livewire.on('modalsummarynote',(data)=>{
        $("#modal-vendormanagement-summarynote").modal('show');
    });

    Livewire.on('modalimprovementpoint',(data)=>{
        $("#modal-vendormanagement-improvementpoint").modal('show');
    });

    

    Livewire.on('modalservicecriteria',(data)=>{
        $("#modal-vendormanagement-servicecriteria").modal('show');
    });

    Livewire.on('modalmaterialcriteria',(data)=>{
        $("#modal-vendormanagement-materialcriteria").modal('show');
    });

    Livewire.on('modaldetailscore',(data)=>{
        $("#modal-vendormanagement-detailscore").modal('show');
    });

    Livewire.on('modalinitialscore',(data)=>{
        $("#modal-vendormanagement-initialscore").modal('show');
    });

    Livewire.on('modalsummarynoteimprovementpoint',(data)=>{
        $("#modal-vendormanagement-summarynoteimprovementpoint").modal('show');
    });

    


    Livewire.on('modalcriteriageneralinformation',(data)=>{
        $("#modal-vendormanagement-criteriageneralinformation").modal('show');
    });

    Livewire.on('modalcriteriateamavailability',(data)=>{
        $("#modal-vendormanagement-criteriateamavailability").modal('show');
    });

    Livewire.on('modalcriteriatoolsfacilities',(data)=>{
        $("#modal-vendormanagement-criteriatoolsfacilities").modal('show');
    });

    Livewire.on('modalcriteriaehs',(data)=>{
        $("#modal-vendormanagement-criteriaehs").modal('show');
    });

    Livewire.on('modalcriteriacc',(data)=>{
        $("#modal-vendormanagement-criteriacc").modal('show');
    });


    Livewire.on('modalviewcomparation',(data)=>{
        $("#modal-vendormanagement-viewcomparation").modal('show');
    });

    Livewire.on('modaladdsupplier',(data)=>{
        $("#modal-vendormanagement-addsupp").modal('show');
    });




@endsection