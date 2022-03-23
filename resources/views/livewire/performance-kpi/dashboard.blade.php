<div>
    <ul class="nav nav-tabs-new" wire:ignore>
        <li class="nav-item"><a class="nav-link active show" wire:click="$set('dashboard_view','commitment_daily')" data-toggle="tab" href="#dashboard-daily-commitment">{{ __('Commitment Daily') }}</a></li>
        <li class="nav-item"><a class="nav-link" wire:click="$set('dashboard_view','health_check')" data-toggle="tab" href="#dashboard-health-check">{{ __('Health Check') }}</a></li>
        <li class="nav-item"><a class="nav-link" wire:click="$set('dashboard_view','vehicle_check')" data-toggle="tab" href="#dashboard-vehicle-check">{{ __('Vehicle Check') }}</a></li>
        <li class="nav-item"><a class="nav-link" wire:click="$set('dashboard_view','ppe_check')" data-toggle="tab" href="#dashboard-ppe-check">{{ __('PPE Check') }}</a></li>
        <li class="nav-item"><a class="nav-link" wire:click="$set('dashboard_view','tools_check')" data-toggle="tab" href="#dashboard-tools-check">{{ __('Tools Check') }}</a></li>
        <li class="nav-item"><a class="nav-link" wire:click="$set('dashboard_view','speed_warning')" data-toggle="tab" href="#dashboard-speed-warning">{{ __('Speed Warning Alarm') }}</a></li>
    </ul>
    <div class="tab-content">
        <span wire:loading>
            <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
            <span class="sr-only">{{ __('Loading...') }} </span> please wait...
        </span>
        <div class="tab-pane {{ $dashboard_view=='commitment_daily' ? 'active' : ''}}" id="dashboard-daily-commitment">
            @if($dashboard_view=='commitment_daily')
                @livewire('performance-kpi.dashboard-commitment-daily')
            @endif
        </div>
        <div class="tab-pane {{ $dashboard_view=='health_check' ? 'active' : ''}}" id="dashboard-health-check">
            @if($dashboard_view=='health_check')
                @livewire('performance-kpi.dashboard-health-check')
            @endif
        </div>
        <div class="tab-pane {{ $dashboard_view=='vehicle_check' ? 'active' : ''}}" id="dashboard-vehicle-check">
            @if($dashboard_view=='vehicle_check')
                @livewire('performance-kpi.dashboard-vehicle-check')
            @endif
        </div>
        <div class="tab-pane {{ $dashboard_view=='ppe_check' ? 'active' : ''}}" id="dashboard-ppe-check">
            @if($dashboard_view=='ppe_check')
                @livewire('performance-kpi.dashboard-ppe-check')
            @endif
        </div>
        <div class="tab-pane {{ $dashboard_view=='tools_check' ? 'active' : ''}}" id="dashboard-tools-check">
            @if($dashboard_view=='tools_check')
                @livewire('performance-kpi.dashboard-tools-check')
            @endif
        </div>
        <div class="tab-pane {{ $dashboard_view=='speed_warning' ? 'active' : ''}}" id="dashboard-speed-warning">
            @if($dashboard_view=='speed_warning')
                @livewire('performance-kpi.dashboard-speed-warning')
            @endif
        </div>
        <style>
            .table-dasboard tr td {
                padding-top:1px !important;
                padding-bottom:1px !important;
            }
        </style>
    </div>
</div>