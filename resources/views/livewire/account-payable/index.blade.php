@section('title', __('Account Payable - Index'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            
            <ul class="nav nav-tabs">
                
                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#data">{{ __('Data') }}</a></li>
            </ul>
            <div class="tab-content">
               
                <div class="tab-pane active show" id="data">
                    <livewire:account-payable.data />
                </div>
               
            </div>
        </div>
        
    </div>
</div>

<div class="modal fade" id="modal-accountpayable-add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:account-payable.add />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-accountpayable-revisi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:account-payable.revisi />
        </div>
    </div>
</div>



<div class="modal fade" id="modal-hotelflight-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:account-payable.edit />
        </div>
    </div>
</div>


<div class="modal fade" id="modal-accountpayable-approve" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:account-payable.approve />
        </div>
    </div>
</div>


<div class="modal fade" id="modal-accountpayable-decline" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:account-payable.decline />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-accountpayable-treasury" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:account-payable.treasury />
        </div>
    </div>
</div>


<div class="modal fade" id="modal-accountpayable-addpettycash" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:account-payable.addpettycash />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-accountpayable-addweeklyopex" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:account-payable.addweeklyopex />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-accountpayable-addotheropex" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:account-payable.addotheropex />
        </div>
    </div>
</div>


<div class="modal fade" id="modal-accountpayable-addrectification" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:account-payable.addrectification />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-accountpayable-addsubcont" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:account-payable.addsubcont />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-accountpayable-addsitekeeper" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:account-payable.addsitekeeper />
        </div>
    </div>
</div>



<div class="modal fade" id="modal-accountpayable-addhqadministration" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:account-payable.addhqadministration />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-accountpayable-addpayroll" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:account-payable.addpayroll />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-accountpayable-addsuppliervendor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:account-payable.addsuppliervendor />
        </div>
    </div>
</div>





@section('page-script')
    Livewire.on('modaladdaccountpayable',(data)=>{
        
        $("#modal-accountpayable-add").modal('show');
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


@endsection