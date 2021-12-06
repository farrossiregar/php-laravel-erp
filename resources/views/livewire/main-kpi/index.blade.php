@section('title', __('Main KPI'))
<div>
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <ul class="nav nav-tabs" wire:ignore>
                @if(check_access('site-tracking.dashboard'))
                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#dashboard_site_list">{{ __('Site List Tracking') }}</a></li>
                @endif
                @if(check_access('preventive-maintenance.dashboard'))
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#dashboard_preventive_maintenance" wire:click="$set('view_index','preventive-maintenance')">{{ __('Preventive Maintenance') }}</a></li>
                @endif
                @if(check_access('site-tracking.dashboard'))
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#dashboard_customer_asset" wire:click="$emit('chart-customer-asset')">{{ __('Customer Asset Management') }}</a></li>
                @endif
                @if(check_access('work-flow-management.dashboard'))
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#wo-never-assigned" wire:click="$set('view_index','work-flow-management')">{{ __('Work Flow Management') }}</a></li>
                @endif
                @if(check_access('critical-case.dashboard'))
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#dashboard-critical-case" wire:click="$emit('chart-critical-case')">{{ __('Critical Case') }}</a></li>
                @endif
            </ul>
            <div class="tab-content">
                <span wire:loading>
                    <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                    <span class="sr-only">{{ __('Loading...') }} </span> please wait...
                </span>
                @if(check_access('site-tracking.dashboard'))
                    <div class="tab-pane {{$view_index=='site-tracking' ? 'show active' : ''}}"" id="dashboard_site_list">
                        @livewire('sitetracking.dashboard')
                    </div>
                @endif
                @if(check_access('preventive-maintenance.dashboard'))
                    <div class="tab-pane {{$view_index=='preventive-maintenance' ? 'show active' : ''}}" id="dashboard_preventive_maintenance">
                        @if($view_index=='preventive-maintenance')
                            @livewire('preventive-maintenance.dashboard')
                        @endif
                    </div>
                @endif
                @if(check_access('site-tracking.dashboard'))
                    <div class="tab-pane" id="dashboard_customer_asset">
                        <livewire:customer-asset-management.dashboard />
                    </div>
                @endif
                @if(check_access('critical-case.dashboard'))
                    <div class="tab-pane" id="dashboard-critical-case">
                        <livewire:criticalcase.dashboard />
                    </div>
                @endif
                @if(check_access('work-flow-management.dashboard'))
                    <div class="tab-pane {{$view_index=='work-flow-management' ? 'show active' : ''}}" id="wo-never-assigned">
                          @livewire('work-flow-management.dashboard')  
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>
@push('after-scripts')
    <script>
        $( document ).ready(function() {
            $('.multiselect_month').multiselect({ 
                    nonSelectedText: ' --- All Month --- ',
                    onChange: function (option, checked) {
                        @this.set('month', $('.multiselect_month').val());
                    },
                    buttonWidth: '100%'
                }
            );
            $('.multiselect_region').multiselect({ 
                    nonSelectedText: ' --- All Region --- ',
                    onChange: function (option, checked) {
                        @this.set('region', $('.multiselect_region').val());
                    },
                    buttonWidth: '100%'
                }
            );

            Livewire.on('chart-wfm',()=>{
                setTimeout(function(){
                    Livewire.emit('init-chart-accept-never-close-wo-manual');
                    Livewire.emit('init-chart-assigned-never-accept-wo');
                    Livewire.emit('init-chart-total-ft-never-close-manual');
                })
            });
        });
    </script>
@endpush