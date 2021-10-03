@section('title', __('Contract Registration Flow - Index'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div>
                <br>
            </div>
            <div>
                <br>
            </div>
            <div>
                <br>
            </div>
            <div>
                <br>
            </div>
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#dashboard" wire:click="$emit('chart')">{{ __('Dashboard') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#data">{{ __('Data') }}</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active show " id="dashboard">
                    <livewire:contract-registration-flow.dashboard />
                </div>
                <div class="tab-pane" id="data">
                    <livewire:contract-registration-flow.data />
                </div>
            </div>
        </div>
        
    </div>
</div>

<div class="modal fade" id="modal-businessopportunities-input" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:business-opportunities.input />
        </div>
    </div>
</div>

<!-- <div class="modal fade" id="modal-dutyroster-revisidutyroster" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:duty-roster.revisidutyroster />
        </div>
    </div>
</div> -->


<div class="modal fade" id="modal-businessopportunities-wonbo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:business-opportunities.wonbo />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-businessopportunities-failedbo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:business-opportunities.failedbo />
        </div>
    </div>
</div>



@section('page-script')


    Livewire.on('modalimportnoc',(data)=>{
        $("#modal-dutyroster-importdutyroster").modal('show');
    });

    Livewire.on('modalrevisidutyroster',(data)=>{
        $("#modal-dutyroster-revisidutyroster").modal('show');
    });

    Livewire.on('modalwonbo',(data)=>{
        $("#modal-businessopportunities-wonbo").modal('show');
    });

    Livewire.on('modalfailedbo',(data)=>{
        $("#modal-businessopportunities-failedbo").modal('show');
    });

@endsection