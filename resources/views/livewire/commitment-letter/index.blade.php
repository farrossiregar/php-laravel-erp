@section('title', __('Duty Roster Region Tools'))
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
                    <livewire:commitment-letter.dashboard />
                </div>
                <div class="tab-pane" id="data">
                    <livewire:commitment-letter.data />
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal-regiontools-inputtools" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:duty-roster-regiontools.inputtools />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-regiontools-edittools" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <!-- livewire:duty-roster-regiontools.edittools /> -->
        </div>
    </div>
</div>

<div class="modal fade" id="modal-regiontools-inputdistribution" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <!-- livewire:duty-roster-regiontools.inputdistribution /> -->
        </div>
    </div>
</div>

<div class="modal fade" id="modal-regiontools-editdatadistribution" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <!-- livewire:duty-roster-regiontools.editdatadistribution /> -->
        </div>
    </div>
</div>

<div class="modal fade" id="modal-regiontools-returntools" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <!-- livewire:duty-roster-regiontools.returntools /> -->
        </div>
    </div>
</div>

<div class="modal fade" id="modal-regiontools-approvaldistribution" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <!-- livewire:duty-roster-regiontools.approvaldistribution /> -->
        </div>
    </div>
</div>

<div class="modal fade" id="modal-regiontools-approvaldreturn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <!-- livewire:duty-roster-regiontools.approvaldreturn /> -->
        </div>
    </div>
</div>

@section('page-script')
    Livewire.on('modalinputtools',(data)=>{
        $("#modal-regiontools-inputtools").modal('show');
    });

    Livewire.on('modaledittools',(data)=>{
        $("#modal-regiontools-edittools").modal('show');
    });

    Livewire.on('modalinputdistribution',(data)=>{
        $("#modal-regiontools-inputdistribution").modal('show');
    });

    Livewire.on('modaleditdatadistribution',(data)=>{
        $("#modal-regiontools-editdatadistribution").modal('show');
    });

    Livewire.on('modalreturntools',(data)=>{
        $("#modal-regiontools-returntools").modal('show');
    });

    Livewire.on('modalapprovaldistribution',(data)=>{
        $("#modal-regiontools-approvaldistribution").modal('show');
    });

    Livewire.on('modalapprovalreturn',(data)=>{
        $("#modal-regiontools-approvalreturn").modal('show');
    });
@endsection