
@section('title', 'Preventive Maintenance')
<div class="row clearfix">
    @push('after-scripts')
        <script type="text/javascript" src="{{ asset('assets/vendor/daterange/moment.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/vendor/daterange/daterangepicker.js') }}"></script>
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/daterange/daterangepicker.css') }}" />
        <script src="{{ asset('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
        <script src="{{ asset('assets/vendor/chartjs/Chart.bundle.min.js') }}?v=2"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    @endpush
    <div class="col-lg-12">
        <div class="card">
            <ul class="nav nav-tabs-new2">
                @if(check_access('preventive-maintenance.dashboard'))
                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#dashboard">{{ __('Dashboard') }}</a></li>
                @endif
                @if(check_access('preventive-maintenance.raw-data'))
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#data">{{ __('Data') }}</a></li>
                @endif
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#setting">{{ __('Setting SOW') }}</a></li>
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
                <div class="tab-pane" id="setting">
                    @livewire('preventive-maintenance.setting')
                </div>
            </div>
        </div>
    </div>    
</div>