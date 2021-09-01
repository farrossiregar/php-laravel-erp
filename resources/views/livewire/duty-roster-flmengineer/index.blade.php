@section('title', __('Duty Roster FLM Engineer- Index'))
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
                    <livewire:duty-roster-flmengineer.dashboard />
                </div>
                <div class="tab-pane" id="data">
                    <livewire:duty-roster-flmengineer.data />
                </div>
            </div>
        </div>  
    </div>
</div>

<div class="modal fade" id="modal-dutyrosterflmengineer-previewdutyrosterflm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:duty-roster-flmengineer.previewdutyrosterflm />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-dutyrosterflmengineer-approvedutyrosterflm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:duty-roster-flmengineer.approvedutyrosterflm />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-dutyrosterflmengineer-declinedutyrosterflm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:duty-roster-flmengineer.declinedutyrosterflm />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-dutyrosterflmengineer-exportdutyrosterflm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:duty-roster-flmengineer.export />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-dutyrosterflmengineer-revisidutyrosterflm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:duty-roster-flmengineer.revisidutyrosterflm />
        </div>
    </div>
</div>



@section('page-script')


    Livewire.on('modalpreviewdutyrosterflm',(data)=>{
        $("#modal-dutyrosterflmengineer-previewdutyrosterflm").modal('show');
    });

    Livewire.on('modalapprovedutyroster',(data)=>{
        $("#modal-dutyrosterflmengineer-approvedutyrosterflm").modal('show');
    });

    Livewire.on('modaldeclinedutyroster',(data)=>{
        $("#modal-dutyrosterflmengineer-declinedutyrosterflm").modal('show');
    });

    Livewire.on('modalexportdutyrosterflm',(data)=>{
        <!-- $("#modal-dutyrosterflmengineer-exportdutyrosterflm").modal('show'); -->
    });

    Livewire.on('modalrevisidutyrosterflm',(data)=>{
        $("#modal-dutyrosterflmengineer-revisidutyrosterflm").modal('show');
    });
@endsection