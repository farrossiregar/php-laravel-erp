@section('title', __('Asset Database - Index'))
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
                    <livewire:asset-database.dashboard />
                </div>
                <div class="tab-pane" id="data">
                    <livewire:hrga-petty-cash.data />
                </div>
               
            </div>
        </div>
        
    </div>
</div>

<div class="modal fade" id="modal-assetdatabase-add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:asset-database.add />
        </div>
    </div>
</div>


 <div class="modal fade" id="modal-assetdatabase-detailimage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:asset-database.detailimage />
        </div>
    </div>
</div>





<div class="modal fade" id="modal-assetdatabase-importasset" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:asset-database.importasset />
        </div>
    </div>
</div>


@section('page-script')
    Livewire.on('modaladdassetdatabase',(data)=>{
        
        $("#modal-assetdatabase-add").modal('show');
    });

    Livewire.on('modalimportasset',(data)=>{
        $("#modal-assetdatabase-importasset").modal('show');
    });


    Livewire.on('modaleditassetrequest',(data)=>{
        $("#modal-assetrequest-edit").modal('show');
    });

    Livewire.on('modaldetaillocation',(data)=>{
        $("#modal-assetrequest-detaillocation").modal('show');
    });

    Livewire.on('modaldetailimage',(data)=>{
        $("#modal-assetdatabase-detailimage").modal('show');
    });


   

@endsection