@section('title', __('Sales Account Receivable - Index'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            
            <ul class="nav nav-tabs">
                
                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#data">{{ __('Data') }}</a></li>
            </ul>
            <div class="tab-content">
               
                <div class="tab-pane active show" id="data">
                    <livewire:sales-account-receivable.data />
                </div>
               
            </div>
        </div>
        
    </div>
</div>

<div class="modal fade" id="modal-accountpayable-add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:sales-account-receivable.add />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-salesaccountreceivable-addpo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:sales-account-receivable.addpo />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-salesaccountreceivable-detailinvoicedesc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:sales-account-receivable.detailinvoicedesc />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-salesaccountreceivable-updateaging" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:sales-account-receivable.updateaging />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-salesaccountreceivable-treasurysalesar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:sales-account-receivable.treasurysalesar />
        </div>
    </div>
</div>


@section('page-script')
    Livewire.on('detailinvoicedesc',(data)=>{
        
        $("#modal-salesaccountreceivable-detailinvoicedesc").modal('show');
    });

    Livewire.on('updateaging',(data)=>{
        
        $("#modal-salesaccountreceivable-updateaging").modal('show');
    });

    Livewire.on('treasurysalesar',(data)=>{
        
        $("#modal-salesaccountreceivable-treasurysalesar").modal('show');
    });


    Livewire.on('modaladdaccountpayable',(data)=>{
        
        $("#modal-accountpayable-add").modal('show');
    });

    Livewire.on('addposalesar',(data)=>{
        
        $("#modal-salesaccountreceivable-addpo").modal('show');
    });

    Livewire.on('modalrevisiaccountpayable',(data)=>{
        
        $("#modal-accountpayable-revisi").modal('show');
    });


    Livewire.on('modaledithotelflightticket',(data)=>{
        $("#modal-hotelflight-edit").modal('show');
    });


    Livewire.on('modalapproveaccountpayable',(data)=>{
        $("#modal-accountpayable-approve").modal('show');
    });


    Livewire.on('modaldeclineaccountpayable',(data)=>{
        $("#modal-accountpayable-decline").modal('show');
    });

    Livewire.on('modaldetailreqaccountpayable',(data)=>{
        $("#modal-accountpayable-detailreq").modal('show');
    });

    Livewire.on('modaltreasuryaccountpayable',(data)=>{
        $("#modal-accountpayable-treasury").modal('show');
    });

    Livewire.on('modaladdpettycashaccountpayable',(data)=>{
        
        $("#modal-accountpayable-addpettycash").modal('show');
    });

    Livewire.on('modaladdweeklyopexaccountpayable',(data)=>{
        
        $("#modal-accountpayable-addweeklyopex").modal('show');
    });

    Livewire.on('modaladdotheropexaccountpayable',(data)=>{
        
        $("#modal-accountpayable-addotheropex").modal('show');
    });



    Livewire.on('modaladdrectificationaccountpayable',(data)=>{
        
        $("#modal-accountpayable-addrectification").modal('show');
    });

    Livewire.on('modaladdsubcontaccountpayable',(data)=>{
        
        $("#modal-accountpayable-addsubcont").modal('show');
    });

    Livewire.on('modaladdsitekeeperaccountpayable',(data)=>{
        
        $("#modal-accountpayable-addsitekeeper").modal('show');
    });



    Livewire.on('modaladdhqadministrationaccountpayable',(data)=>{
        
        $("#modal-accountpayable-addhqadministration").modal('show');
    });

    Livewire.on('modaladdpayrollaccountpayable',(data)=>{
        
        $("#modal-accountpayable-addpayroll").modal('show');
    });


    Livewire.on('modaladdsuppliervendoraccountpayable',(data)=>{
        
        $("#modal-accountpayable-addsuppliervendor").modal('show');
    });


    Livewire.on('modaldetailpettycashaccountpayable',(data)=>{
        $("#modal-accountpayable-detailpettycash").modal('show');
    });

@endsection