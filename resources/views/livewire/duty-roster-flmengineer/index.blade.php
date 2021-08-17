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
<!-- 
<div class="modal fade" id="modal-dutyrosterflm-editdata" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:duty-roster-flmengineer.editdata />
        </div>
    </div>
</div> -->

<div class="modal fade" id="modal-dutyroster-revisidutyroster" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:duty-roster.revisidutyroster />
        </div>
    </div>
</div>


<div class="modal fade" id="modal-dutyroster-approvedutyroster" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:duty-roster.approvedutyroster />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-dutyroster-declinedutyroster" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:duty-roster.declinedutyroster />
        </div>
    </div>
</div>



@section('page-script')


    Livewire.on('modaleditdutyrosterflm',(data)=>{
        $("#modal-dutyrosterflm-editdata").modal('show');
    });

    Livewire.on('modalrevisidutyroster',(data)=>{
        $("#modal-dutyroster-revisidutyroster").modal('show');
    });

    Livewire.on('modalapprovedutyroster',(data)=>{
        $("#modal-dutyroster-approvedutyroster").modal('show');
    });

    Livewire.on('modaldeclinedutyroster',(data)=>{
        $("#modal-dutyroster-declinedutyroster").modal('show');
    });

@endsection