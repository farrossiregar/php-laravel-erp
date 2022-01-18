@section('title', __('Consumable Item Database - Index'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#dashboard" wire:click="$emit('chart')">{{ __('Dashboard') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#datareq">{{ __('Item Request') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#dataitem">{{ __('Item Database') }}</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active show " id="dashboard">
                    <livewire:consumable-item-database.dashboard />
                </div>
                <div class="tab-pane" id="datareq">
                    <livewire:consumable-item-database.datareq />
                </div>
                <div class="tab-pane" id="dataitem">
                    <livewire:consumable-item-database.dataitem />
                </div>
               
            </div>
        </div>
        
    </div>
</div>

<div class="modal fade" id="modal-consumableitemdatabase-add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:consumable-item-database.add />
        </div>
    </div>
</div>




<div class="modal fade" id="modal-consumableitemdatabase-importasset" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:asset-database.importasset />
        </div>
    </div>
</div>


@section('page-script')
    Livewire.on('modaladdconsumableitemdatabase',(data)=>{
        
        $("#modal-consumableitemdatabase-add").modal('show');
    });

    Livewire.on('modalimportconsumableitemdatabase',(data)=>{
        $("#modal-consumableitemdatabase-import").modal('show');
    });


    Livewire.on('modaleditconsumableitemdatabase',(data)=>{
        $("#modal-consumableitemdatabase-edit").modal('show');
    });

   

@endsection