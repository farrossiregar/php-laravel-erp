@section('title', __('Database Tools NOC'))
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
                    <livewire:database-tools-noc.data />
                </div>
                <div class="tab-pane" id="data">
                    <livewire:database-tools-noc.data />
                </div>
            </div>
        </div>
        
    </div>
</div>

<div class="modal fade" id="modal-databasenoc-importnoc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:database-noc.importnoc />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-databasenoc-revisenoc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:database-noc.revisenoc />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-databasenoc-approvenoc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:database-noc.approvenoc />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-databasenoc-declinenoc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:database-noc.declinenoc />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-databasenoc-previewnoc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:database-noc.previewnoc />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-databasenoc-addtoolsnoc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:database-tools-noc.addtoolsnoc />
        </div>
    </div>
</div>

@section('page-script')
    Livewire.on('modalimportnoc',(data)=>{
        $("#modal-databasenoc-importnoc").modal('show');
    });

    Livewire.on('modalrevisenoc',(data)=>{
        $("#modal-databasenoc-revisenoc").modal('show');
    });

    Livewire.on('modaldeclinedatabasenoc',(data)=>{
        $("#modal-databasenoc-declinenoc").modal('show');
    });

    Livewire.on('modalapprovedatabasenoc',(data)=>{
        $("#modal-databasenoc-approvenoc").modal('show');
    });

    Livewire.on('modalpreviewnoc',(data)=>{
        $("#modal-databasenoc-previewnoc").modal('show');
    });

    Livewire.on('modaladdtoolsnoc',(data)=>{
        $("#modal-databasenoc-addtoolsnoc").modal('show');
    });

@endsection