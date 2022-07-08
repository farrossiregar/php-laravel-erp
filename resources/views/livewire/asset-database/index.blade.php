@section('title', __('Asset Database'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#data">{{ __('Data') }}</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active show" id="data">
                    <livewire:asset-database.dashboard />
                    <livewire:asset-database.data />
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

<div class="modal fade" id="modal-assetdatabase-importasset" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:asset-database.importasset />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-assetdatabase-transferasset" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:asset-database.transferasset />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-assetdatabase-detailasset" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:asset-database.detailasset />
        </div>
    </div>
</div>

<!-- START ASSET REQUEST -->
<div class="modal fade" id="modal-assetdatabase-detailrequest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:asset-database.detailrequest />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-assetdatabase-detaildana" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:asset-database.detaildana />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-assetdatabase-approvereq" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:asset-database.approvereq />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-assetdatabase-declinereq" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:asset-database.declinereq />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-assetdatabase-approvalhistoryreq" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:asset-database.approvalhistoryreq />
        </div>
    </div>
</div>
<!-- END ASSET REQUEST -->




<!-- START ASSET TRANSFER -->
<div class="modal fade" id="modal-assetdatabase-detailtransfer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:asset-database.detailtransfer />
        </div>
    </div>
</div>


<div class="modal fade" id="modal-assetdatabase-approvetrans" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:asset-database.approvetrans />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-assetdatabase-declinetrans" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:asset-database.declinetrans />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-assetdatabase-approvalhistorytrans" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:asset-database.approvalhistorytrans />
        </div>
    </div>
</div>
<!-- END ASSET TRANSFER -->


@section('page-script')
    Livewire.on('modaladdassetdatabase',(data)=>{
        
        $("#modal-assetdatabase-add").modal('show');
    });

    Livewire.on('modalimportasset',(data)=>{
        $("#modal-assetdatabase-importasset").modal('show');
    });

    Livewire.on('modaltransferasset',(data)=>{
        $("#modal-assetdatabase-transferasset").modal('show');
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


    Livewire.on('modaldetailasset',(data)=>{
        $("#modal-assetdatabase-detailasset").modal('show');
    });

    Livewire.on('modaldetailrequest',(data)=>{
        $("#modal-assetdatabase-detailrequest").modal('show');
    });

    Livewire.on('modaldetaildana',(data)=>{
        $("#modal-assetdatabase-detaildana").modal('show');
    });

    Livewire.on('modaldetailtransfer',(data)=>{
        $("#modal-assetdatabase-detailtransfer").modal('show');
    });

    <!-- START ASSET REQUEST -->
    Livewire.on('modalapproveassetrequest',(data)=>{
        $("#modal-assetdatabase-approvereq").modal('show');
    });

    Livewire.on('modalapprovalhistoryassetrequest',(data)=>{
        $("#modal-assetdatabase-approvalhistoryreq").modal('show');
    });

    Livewire.on('modaldeclineassetrequest',(data)=>{
        $("#modal-assetdatabase-declinereq").modal('show');
    });
    <!-- END ASSET REQUEST -->
   

    <!-- START ASSET TRANSFER -->
    Livewire.on('modalapproveassettrans',(data)=>{
        $("#modal-assetdatabase-approvetrans").modal('show');
    });

    Livewire.on('modalapprovalhistoryassettrans',(data)=>{
        $("#modal-assetdatabase-approvalhistorytrans").modal('show');
    });

    Livewire.on('modaldeclineassettrans',(data)=>{
        $("#modal-assetdatabase-declinetrans").modal('show');
    });
    <!-- END ASSET TRANSFER -->

@endsection