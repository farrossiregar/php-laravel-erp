@section('title', __('Performance KPI'))
@push('after-scripts')
<script type="text/javascript" src="{{ asset('assets/vendor/daterange/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendor/daterange/daterangepicker.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/daterange/daterangepicker.css') }}" />
@endpush
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <ul class="nav nav-tabs-new2" wire:ignore>
                <li class="nav-item"><a class="nav-link active show" wire:click="$set('view_index','dashboard')" data-toggle="tab" href="#dashboard">{{ __('Dashboard') }}</a></li>
                <li class="nav-item"><a class="nav-link" wire:click="$set('view_index','commitment_daily')" data-toggle="tab" href="#commitment-daily">{{ __('Commitment Daily') }}</a></li>
                <li class="nav-item"><a class="nav-link" wire:click="$set('view_index','health_check')" data-toggle="tab" href="#health-check">{{ __('Health Check') }}</a></li>
                <li class="nav-item"><a class="nav-link" wire:click="$set('view_index','vehicle_check')" data-toggle="tab" href="#vehicle-check">{{ __('Vehicle Check') }}</a></li>
                <li class="nav-item"><a class="nav-link" wire:click="$set('view_index','ppe_check')" data-toggle="tab" href="#ppe-check">{{ __('PPE Check') }}</a></li>
                <li class="nav-item"><a class="nav-link" wire:click="$set('view_index','tools_check')" data-toggle="tab" href="#tools-check">{{ __('Tools Check') }}</a></li>
                <li class="nav-item"><a class="nav-link" wire:click="$set('view_index','speed_warning')" data-toggle="tab" href="#speed-warning-alarm">{{ __('Speed Warning Alarm') }}</a></li>
            </ul>
            <div class="tab-content">
                <span wire:loading>
                    <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                    <span class="sr-only">{{ __('Loading...') }} </span> please wait...
                </span>
                <div class="tab-pane {{ $view_index=='dashboard' ? 'active' : ''}}" id="dashboard">
                    @if($view_index=='dashboard')
                        @livewire('performance-kpi.dashboard')
                    @endif
                </div>
                <div class="tab-pane {{ $view_index=='commitment_daily' ? 'active' : ''}}" id="commitment-daily">
                    @if($view_index=='commitment_daily')
                        @livewire('mobile-apps.commitment-daily')
                    @endif
                </div>
                <div class="tab-pane {{ $view_index=='health_check' ? 'active' : ''}}" id="health-check">
                    @livewire('mobile-apps.health-check')
                </div>
                <div class="tab-pane {{ $view_index=='vehicle_check' ? 'active' : ''}}" id="vehicle-check">
                    @if($view_index=='vehicle_check')
                        @livewire('mobile-apps.vehicle-check')
                    @endif
                </div>
                <div class="tab-pane {{ $view_index=='ppe_check' ? 'active' : ''}}" id="ppe-check">
                    @if($view_index=='ppe_check')
                        @livewire('mobile-apps.ppe-check')
                    @endif
                </div>
                <div class="tab-pane {{ $view_index=='tools_check' ? 'active' : ''}}" id="tools-check">
                    @if($view_index=='tools_check')
                        @livewire('mobile-apps.tools-check')
                    @endif
                </div>
                <div class="tab-pane {{ $view_index=='speed_warning' ? 'active' : ''}}" id="speed-warning-alarm">
                    @if($view_index=='speed_warning')
                        @livewire('mobile-apps.speed-warning-alarm')
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@push('after-scripts')
    <script>
        Livewire.on('refresh-page',()=>{
            $("#modal_delete_hc").modal('hide');
        });
        Livewire.on('clear_daterange',()=>{
            $(".date_range_commitment_daily").val("");
        });
        Livewire.on('refresh-page',()=>{
            $("#modal_delete_pc").modal('hide');
            $("#modal_delete_vc").modal('hide');
        });
    </script>
@endpush