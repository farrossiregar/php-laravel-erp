@section('title', __('Main KPI'))
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
            <ul class="nav nav-tabs-new2" wire:ignore>
                @if(check_access('site-tracking.dashboard'))
                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#dashboard_site_list" wire:click="$set('view_index','site-tracking')">{{ __('Site List Tracking') }}</a></li>
                @endif
                @if(check_access('preventive-maintenance.dashboard'))
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#dashboard_preventive_maintenance" wire:click="$set('view_index','preventive-maintenance')">{{ __('Preventive Maintenance') }}</a></li>
                @endif
                @if(check_access('customer-asset-management.dashboard'))
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#dashboard_customer_asset" wire:click="$set('view_index','chart-customer-asset')">{{ __('Customer Asset Management') }}</a></li>
                @endif
                @if(check_access('work-flow-management.dashboard'))
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#wo-never-assigned" wire:click="$set('view_index','work-flow-management')">{{ __('Work Flow Management') }}</a></li>
                @endif
                @if(check_access('critical-case.dashboard'))
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#dashboard-critical-case" wire:click="$emit('chart-critical-case')">{{ __('Critical Case') }}</a></li>
                @endif
                <li>
                    <span wire:loading>
                        <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                        <span class="sr-only">{{ __('Loading...') }} </span> load data ...
                    </span>
                </li>
            </ul>
            <div class="tab-content" wire:ignore>
                @if(check_access('site-tracking.dashboard'))
                    <div class="tab-pane {{$view_index=='site-tracking' ? 'show active' : ''}}"" id="dashboard_site_list">
                        @livewire('main-kpi.sitetracking')
                    </div>
                @endif
                @if(check_access('preventive-maintenance.dashboard'))
                    <div class="tab-pane {{$view_index=='preventive-maintenance' ? 'show active' : ''}}" id="dashboard_preventive_maintenance">
                        @livewire('main-kpi.preventive-maintenance-dashboard')
                    </div>
                @endif
                @if(check_access('customer-asset-management.dashboard'))
                    <div class="tab-pane" id="dashboard_customer_asset">
                        @livewire('main-kpi.customer-asset')
                    </div>
                @endif
                @if(check_access('critical-case.dashboard'))
                    <div class="tab-pane" id="dashboard-critical-case">
                        @livewire('criticalcase.dashboard')
                    </div>
                @endif
                @if(check_access('work-flow-management.dashboard'))
                    <div class="tab-pane {{$view_index=='work-flow-management' ? 'show active' : ''}}" id="wo-never-assigned">
                          @livewire('main-kpi.work-flow')  
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>