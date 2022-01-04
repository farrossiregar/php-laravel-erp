@section('title', __('Commitment Letter'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#dashboard" wire:click="$emit('chart')">{{ __('Dashboard') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#data">{{ __('Data ') }}</a></li>
                <!-- <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#datapmt">{{ __('Data PMT') }}</a></li> -->
            </ul>
            <div class="tab-content">
                <div class="tab-pane active show " id="dashboard">
                    <livewire:commitment-letter.dashboard />
                </div>
                <div class="tab-pane" id="data">
                    <livewire:commitment-letter.datahup />
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal-commitmentletter-addhup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:commitment-letter.addhup />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-commitmentletter-addpmt" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:commitment-letter.addpmt />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-commitmentletter-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:commitment-letter.edit />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-commitmentletter-importbcg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:commitment-letter.importbcg />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-commitmentletter-importcybersecurity" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:commitment-letter.importcybersecurity />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-commitmentletter-importdoc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:commitment-letter.importdoc />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-commitmentletter-approve" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:commitment-letter.approve />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-commitmentletter-decline" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:commitment-letter.decline />
        </div>
    </div>
</div>


@section('page-script')
    Livewire.on('modaladdhupcommitmentletter',(data)=>{
        $("#modal-commitmentletter-addhup").modal('show');
    });

    Livewire.on('modaladdpmtcommitmentletter',(data)=>{
        $("#modal-commitmentletter-addpmt").modal('show');
    });

    Livewire.on('modaleditcommitmentletter',(data)=>{
        $("#modal-commitmentletter-edit").modal('show');
    });

    Livewire.on('modalimportbcg',(data)=>{
        console.log(data);
        $("#modal-commitmentletter-importbcg").modal('show');
    });

    Livewire.on('modalimportcybersecurity',(data)=>{
        console.log(data);
        $("#modal-commitmentletter-importcybersecurity").modal('show');
    });

    Livewire.on('modalimportdoc',(data)=>{
        console.log(data);
        $("#modal-commitmentletter-importdoc").modal('show');
    });

    Livewire.on('modalapprovecommitmentletter',(data)=>{
        console.log(data);
        $("#modal-commitmentletter-approve").modal('show');
    });

    Livewire.on('modaldeclinecommitmentletter',(data)=>{
        console.log(data);
        $("#modal-commitmentletter-decline").modal('show');
    });

   
@endsection