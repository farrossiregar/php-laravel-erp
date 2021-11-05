
@section('title', 'Preventive Maintenance')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <ul class="nav nav-tabs-new2">
                @if(check_access('preventive-maintenance.dashboard'))
                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#dashboard">{{ __('Dashboard') }}</a></li>
                @endif
                @if(check_access('preventive-maintenance.raw-data'))
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#data">{{ __('Data') }}</a></li>
                @endif
            </ul>
            <div class="tab-content">
                @if(check_access('preventive-maintenance.dashboard'))
                    <div class="tab-pane active show" id="dashboard">
                        @livewire('preventive-maintenance.dashboard')
                    </div>
                @endif
                @if(check_access('preventive-maintenance.raw-data'))
                    <div class="tab-pane" id="data">
                        @livewire('preventive-maintenance.data')
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
