@section('title', __('Business Opportunities'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#dashboard" wire:click="$emit('chart')">{{ __('Dashboard') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#businessopportunity">{{ __('New Business Opportunity') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#contractregistrationflow">{{ __('Contract Registration') }}</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active show " id="dashboard">
                    <livewire:business-opportunities.dashboard />
                </div>
                <div class="tab-pane" id="businessopportunity">
                    <livewire:business-opportunities.data />
                </div>
                <div class="tab-pane" id="contractregistrationflow">
                    <livewire:contract-registration-flow.data />
                </div>
            </div>
        </div>
        
    </div>
</div>

<div class="modal fade" id="modal-businessopportunities-wonbo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:business-opportunities.wonbo />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-businessopportunities-failedbo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:business-opportunities.failedbo />
        </div>
    </div>
</div>


<div class="modal fade" id="modal-contractregistrationflow-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:contract-registration-flow.edit />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-contractregistrationflow-importcontract" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:contract-registration-flow.importcontract />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-contractregistrationflow-importtoolsbudget" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:contract-registration-flow.importtoolsbudget />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-contractregistrationflow-importvehiclebudget" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:contract-registration-flow.importvehiclebudget />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-contractregistrationflow-importresourcebudget" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:contract-registration-flow.importresourcebudget />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-contractregistrationflow-importofficebase" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:contract-registration-flow.importofficebase />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-contractregistrationflow-importopexbudget" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:contract-registration-flow.importopexbudget />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-contractregistrationflow-importtimeline" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:contract-registration-flow.importtimeline />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-contractregistrationflow-importbudgetpreparation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:contract-registration-flow.importbudgetpreparation />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-contractregistrationflow-importrevenue" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:contract-registration-flow.importrevenue />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-contractregistrationflow-importresourcepreparation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:contract-registration-flow.importresourcepreparation />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-contractregistrationflow-importkickof" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:contract-registration-flow.importkickof />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-contractregistrationflow-importorgchart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:contract-registration-flow.importorgchart />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-contractregistrationflow-importteamdimension" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:contract-registration-flow.importteamdimension />
        </div>
    </div>
</div>



<div class="modal fade" id="modal-contractregistrationflow-closecontract" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:contract-registration-flow.closecontract />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-contractregistrationflow-closecontract" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:contract-registration-flow.closecontract />
        </div>
    </div>
</div>
@section('page-script')
    Livewire.on('modalwonbo',(data)=>{
        $("#modal-businessopportunities-wonbo").modal('show');
    });

    Livewire.on('modalfailedbo',(data)=>{
        $("#modal-businessopportunities-failedbo").modal('show');
    });


    Livewire.on('modaledit',(data)=>{
        
        $("#modal-contractregistrationflow-edit").modal('show');
    });

    Livewire.on('modalimportcontract',(data)=>{
        
        $("#modal-contractregistrationflow-importcontract").modal('show');
    });

    Livewire.on('modalimporttoolsbudget',(data)=>{
        
        $("#modal-contractregistrationflow-importtoolsbudget").modal('show');
    });

    Livewire.on('modalimportvehiclebudget',(data)=>{
        
        $("#modal-contractregistrationflow-importvehiclebudget").modal('show');
    });

    Livewire.on('modalimportresourcebudget',(data)=>{
        
        $("#modal-contractregistrationflow-importresourcebudget").modal('show');
    });

    Livewire.on('modalimportofficebase',(data)=>{
        
        $("#modal-contractregistrationflow-importofficebase").modal('show');
    });

    Livewire.on('modalimportopexbudget',(data)=>{
        
        $("#modal-contractregistrationflow-importopexbudget").modal('show');
    });

    Livewire.on('modalimporttimeline',(data)=>{
        
        $("#modal-contractregistrationflow-importtimeline").modal('show');
    });

    Livewire.on('modalimportbudgetpreparation',(data)=>{
        
        $("#modal-contractregistrationflow-importbudgetpreparation").modal('show');
    });

    Livewire.on('modalimportrevenue',(data)=>{
        
        $("#modal-contractregistrationflow-importrevenue").modal('show');
    });

    Livewire.on('modalimportresourcepreparation',(data)=>{
        
        $("#modal-contractregistrationflow-importresourcepreparation").modal('show');
    });

    Livewire.on('modalimportkickof',(data)=>{
        
        $("#modal-contractregistrationflow-importkickof").modal('show');
    });

    Livewire.on('modalimportorgchart',(data)=>{
        
        $("#modal-contractregistrationflow-importorgchart").modal('show');
    });

    Livewire.on('modalimportteamdimension',(data)=>{
        
        $("#modal-contractregistrationflow-importteamdimension").modal('show');
    });

    Livewire.on('modalclosecontract',(data)=>{
        
        $("#modal-contractregistrationflow-closecontract").modal('show');
    });

@endsection