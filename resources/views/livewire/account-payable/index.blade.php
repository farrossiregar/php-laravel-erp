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

@endsection