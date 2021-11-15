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


<div class="modal fade" id="modal-commitmentletter-add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:commitment-letter.add />
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
    Livewire.on('modaladdcommitmentletter',(data)=>{
        $("#modal-commitmentletter-add").modal('show');
    });

    Livewire.on('modalimportbcg',(data)=>{
        console.log(data);
        $("#modal-commitmentletter-importbcg").modal('show');
    });

    Livewire.on('modalimportcybersecurity',(data)=>{
        console.log(data);
        $("#modal-commitmentletter-importcybersecurity").modal('show');
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