@section('title', __('DOP Homebase'))
@section('parentPageTitle', 'Duty Roster')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#dashboard" wire:click="$emit('chart')">{{ __('Dashboard') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#datamaster">{{ __('Data Master') }}</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active show " id="dashboard">
                    <livewire:duty-roster-dophomebase.dashboard />
                </div>
                <div class="tab-pane" id="datamaster">
                    <livewire:duty-roster-dophomebase.datamaster />
                </div>
            </div>
        </div>
        
    </div>
</div>

<div class="modal fade" id="modal-dutyroster-importdutyroster" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:duty-roster-dophomebase.importdutyroster />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-dutyroster-importdutyrostersm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:duty-roster-dophomebase.importdutyrostersm />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-dutyroster-inputdutyroster" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:duty-roster-dophomebase.inputdutyroster />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-dutyroster-updatelongitude" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:duty-roster-dophomebase.updatelongitude />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-dutyroster-updatelatitude" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:duty-roster-dophomebase.updatelatitude />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-dutyroster-uploadimage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:duty-roster-dophomebase.uploadimage />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-dutyroster-revisidutyroster" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:duty-roster-dophomebase.revisidutyroster />
        </div>
    </div>
</div>


<div class="modal fade" id="modal-dutyroster-approvedutyroster" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:duty-roster-dophomebase.approvedutyroster />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-dutyroster-declinedutyroster" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:duty-roster-dophomebase.declinedutyroster />
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

    Livewire.on('modalapprovedutyroster',(data)=>{
        $("#modal-dutyroster-approvedutyroster").modal('show');
    });

    Livewire.on('modaldeclinedutyroster',(data)=>{
        $("#modal-dutyroster-declinedutyroster").modal('show');
    });
    
    Livewire.on('modalinputdop',(data)=>{
        $("#modal-dutyroster-inputdutyroster").modal('show');
    });

    Livewire.on('modalupdatelong',(data)=>{
        $("#modal-dutyroster-updatelongitude").modal('show');
    });

    Livewire.on('modalupdatelat',(data)=>{
        $("#modal-dutyroster-updatelatitude").modal('show');
    });

    Livewire.on('modaluploadimage',(data)=>{
        $("#modal-dutyroster-uploadimage").modal('show');
    });
    
@endsection