@section('title', __('Accident Report - Index'))
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
                    <livewire:accident-report.dashboard />
                </div>
                <div class="tab-pane" id="data">
                    <livewire:accident-report.data />
                </div>
            </div>
           
        </div>
    </div>
</div>

<div class="modal fade" id="modal-accidentreport-previewdata" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:accident-report.previewaccident />
        </div>
    </div>
</div>


@section('page-script')


    Livewire.on('modalpreview',(data)=>{
        $("#modal-accidentreport-previewdata").modal('show');
    });

@endsection